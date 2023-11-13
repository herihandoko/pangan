<?php

namespace App\Services;

use App\Model\Label\Label;
use App\Repositories\ConfigRevenueSharingRepository;
use App\Repositories\EarningMonthRepository;
use App\Repositories\LabelRepository;
use App\Repositories\MusicHasVideoRepository;
use App\Repositories\MusicRepository;
use App\Repositories\RevenueStakeholderRepository;
use App\Repositories\UserBankRepository;
use App\Repositories\UserLabelRepository;
use Illuminate\Support\Facades\Log;
use DataTables;
use Exception;

class LabelService
{
    protected $labelRepository;
    protected $musicRepository;
    protected $musicHasVideoRepo;
    protected $userLabelRepository;
    protected $revenueStakeholderRepo;
    protected $earningMonthRepo;
    protected $configRevenueRepo;
    protected $userBankRepo;

    public function __construct(
        LabelRepository $labelRepository,
        MusicRepository $musicRepository,
        MusicHasVideoRepository $musicHasVideoRepo,
        UserLabelRepository $userLabelRepository,
        RevenueStakeholderRepository $revenueStakeholderRepo,
        EarningMonthRepository $earningMonthRepo,
        ConfigRevenueSharingRepository $configRevenueRepo,
        UserBankRepository $userBankRepo,
    ) {
        $this->labelRepository = $labelRepository;
        $this->musicRepository = $musicRepository;
        $this->musicHasVideoRepo = $musicHasVideoRepo;
        $this->userLabelRepository = $userLabelRepository;
        $this->revenueStakeholderRepo = $revenueStakeholderRepo;
        $this->earningMonthRepo = $earningMonthRepo;
        $this->configRevenueRepo = $configRevenueRepo;
        $this->userBankRepo = $userBankRepo;
    }

    public function getAllLabelsAndRelatedData(): ?object
    {
        return $this->labelRepository->fetchWithRelationship();
    }

    public function getAllLabelWithRevenue(): ?object
    {
        return $this->labelRepository->fetchLabelWithRevenue();
    }

    public function getLabelDetailsById(int $id): ?object
    {
        return $this->labelRepository->findByIdWithRelationship($id);
    }

    public function getMusicListByLabelId(int $labelId): ?object
    {
        return $this->musicRepository->getMusicsByLabel($labelId);
    }

    public function getRevenueShareByLabel(int $labelId): ?object
    {
        return $this->revenueStakeholderRepo->getRevenueShareByLabel($labelId);
    }

    public function getDetailRevenueContent(int $labelId, $date): ?object
    {
        $configRevenueShare = $this->configRevenueRepo->getRevenueSharingByMonth($date);
        $totalDuration = $this->earningMonthRepo->getTotalDurationByDate($date);
        $earningDurationLabel = $this->earningMonthRepo->getDetailRevenueContentByDate($labelId, $date);

        $earningDurationLabel->transform(function ($earning) use ($configRevenueShare, $totalDuration) {
            $revenue = ($earning->earning_duration_label / $totalDuration) * $configRevenueShare;

            $earning->total_revenue = formatCurrency($revenue, 'Rp ');
            $earning->video_title = $earning->content->video_title;
            $earning->video_id = $earning->content->id;

            unset($earning->content);
            return $earning;
        });

        return $earningDurationLabel;
    }


    public function getMusicVideoListByLabel(Label $label, $status): ?object
    {
        $data = $this->musicHasVideoRepo->getMusicVideoByLabel($label);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('id', function ($row) {
                return $row->video_id;
            })
            ->addColumn('video_title', function ($row) {
                return $row->video_title;
            })
            ->addColumn('creator', function ($row) {
                return $row->creator->display_name ?? "-";
            })
            ->addColumn('song_title', function ($row) {
                return $row->title;
            })
            ->addColumn('artist', function ($row) {
                return $row->artist;
            })
            ->addColumn('label_name', function ($row)  use ($label) {
                return $label->name;
            })
            ->addColumn('claim_status', function ($row) {
                return labelRender($row->status ?? "not_claimed", 'label_registered');
            })
            ->addColumn('claim_date', function ($row) {
                return formatDateTime($row->created_at ?? "-", 'd-m-Y');
            })
            ->filter(function ($query) use ($status) {
                $statusFilter = $status;

                if ($statusFilter === 'not_claimed') {
                    $query->where(function ($w) {
                        $w->whereNull('status')->orWhere('status', 'not_claimed');
                    });
                } else if ($statusFilter !== null) {
                    $query->where('status', $statusFilter);
                }
            })
            ->make(true);
    }

    public function getUserLabelByLabelWithFilter($status): ?object
    {
        return $this->userLabelRepository->getUserLabelByLabelWithFilter($status);
    }

    public function updateLabelStatus(object $params)
    {
        try {
            $label = $this->userLabelRepository->getUserLabelByFilter([
                'label_id' => $params->label_id,
                'status' => $params->status
            ]);

            if ($label) {
                return [
                    'success' => false,
                    'message' => 'Label is already have User Label',
                ];
            }

            $this->userLabelRepository->updateUserLabelById($params->id, $params->status);

            if ($params->status === 'approved') {
                $this->userLabelRepository->updateUserLabelByLabel($params->id, $params->label_id, 'rejected');
            }

            return [
                'success' => true,
                'message' => 'Update module success',
            ];
        } catch (\Exception $e) {
            // Handle any exceptions here
            Log::error($e);

            return [
                'success' => false,
                'message' => 'Failed to update module: ' . $e->getMessage(),
            ];
        }
    }

    public function updateAccountBank(array $params)
    {
        try {
            if ($params['creator_id'] === '-') {
                throw new Exception("The label is not registered yet.");
            }

            $skbp = $params['document_skbp'] ?? null;
            $skbp = $skbp ? 1 : 0;
            if (request()->hasFile('document_skbp')) {
                $extension = request()->file('document_skbp')->getClientOriginalExtension();
                $filenameSimpan = $params['creator_id'] . '_' . 'skbp' . '_' . time() . '.' . $extension;

                if (!request()->file('document_skbp')->storeAs('/', $filenameSimpan, ['disk' => 'user_files'])) {
                    throw new Exception("Document failed to upload.");
                }
                $params['document_skbp'] = $filenameSimpan;
            }
            
            $this->userBankRepo->updateAccountBank(array_merge($params, [
                'type' => 'badan_usaha',
                'is_label' => 1,
                'skbp' => $skbp,
            ]));

            return [
                'success' => true,
                'message' => 'Update account bank success',
            ];
        } catch (\Exception $e) {
            // Handle any exceptions here
            Log::error($e);

            return [
                'success' => false,
                'message' => 'Failed to update account bank: ' . $e->getMessage(),
                'error' => $e->getMessage(),
            ];
        }
    }
}

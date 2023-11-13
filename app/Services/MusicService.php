<?php

namespace App\Services;

use App\Repositories\MusicClaimRepository;
use App\Repositories\MusicHasVideoRepository;
use App\Repositories\VideosRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MusicService
{
    protected $musicClaimRepository;
    protected $videoRepository;
    protected $musicHasVideoRepo;
    protected $notificationService;

    public function __construct(
        MusicClaimRepository $musicClaimRepository,
        VideosRepository $videoRepository,
        MusicHasVideoRepository $musicHasVideoRepo,
        NotificationApiService $notificationService
    ) {
        $this->musicClaimRepository = $musicClaimRepository;
        $this->videoRepository = $videoRepository;
        $this->musicHasVideoRepo = $musicHasVideoRepo;
        $this->notificationService = $notificationService;
    }

    public function getMusicClaimByStatus($status): ?object
    {
        return $this->musicClaimRepository->getMusicClaimByStatus($status);
    }

    public function updateClaimMusic($id, $status)
    {
        try {
            DB::beginTransaction();

            $claimMusic = $this->musicClaimRepository->updateClaimMusic($id, $status);

            if ($claimMusic->status !== 'approved') {
                // Commit the transaction and return a success response
                DB::commit();

                return [
                    'success' => true,
                    'message' => 'Status updated successfully.',
                ];
            }

            if ($claimMusic->submission_type === 'take_down') {
                $this->videoRepository->muteMusic($claimMusic->video_id, (object)[
                    'video_source' => $claimMusic->musicMetadata->source_video_muted
                ]);
                $this->musicHasVideoRepo->deleteByFilter((object)[
                    'music_id' => $claimMusic->music_id,
                    'video_id' => $claimMusic->video_id,
                    'creator_id' => $claimMusic->creator_id,
                ]);
            }

            $notif = $this->notificationService->sendNotification([
                "identity" => $claimMusic->creator_id,
                "ts" => now()->timestamp,
                "type" => "event",
                "evtName" => "User Get Claim Music",
                "evtData" => [
                    "title_video" => $claimMusic->title,
                    "label_name" => $claimMusic->label->name,
                    "claim_type" => $claimMusic->submission_type,
                    "deeplink" => "rctiplus://rctiplus.com/profile"
                ]
            ]);

            // Commit the transaction
            DB::commit();

            return [
                'success' => true,
                'message' => 'Status updated successfully.',
                'notif' => $notif['message']
            ];
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Log the exception for debugging purposes
            Log::error($e);

            return [
                'success' => false,
                'message' => 'Failed to update claim status: ' . $e->getMessage(),
            ];
        }
    }
}

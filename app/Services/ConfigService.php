<?php

namespace App\Services;

use App\Repositories\ConfigsRepository;
use Illuminate\Support\Facades\Log;

class ConfigService
{
    protected $configRepo;

    public function __construct(ConfigsRepository $configRepo)
    {
        $this->configRepo = $configRepo;
    }

    public function getConfigByKey(string $key): ?object
    {
        return $this->configRepo->getConfigByKey($key);
    }

    public function updateWording($id, array $fields): ?array
    {
        try {
            $this->configRepo->updateWording($id, $fields);
            return [
                'success' => true,
                'message' => 'config updated successfully.',
            ];
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            Log::error($e);

            return [
                'success' => false,
                'message' => 'Failed to update config: ' . $e->getMessage(),
            ];
        }
    }
}

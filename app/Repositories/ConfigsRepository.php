<?php

namespace App\Repositories;

use App\Model\Configs;
use Illuminate\Support\Facades\Auth;

class ConfigsRepository
{
    protected $config;

    public function __construct(Configs $config)
    {
        $this->config = $config;
    }

    public function getConfigByKey(string $key): ?object
    {
        return $this->config
            ->select(['id', 'key', 'value', 'updated_at', 'updated_by'])
            ->with(['updatedBy' => function ($q) {
                $q->select(['id', 'name']);
            }])
            ->where('key', $key)
            ->first();
    }

    public function updateWording($id, $fields)
    {
        try {
            return $this->config->where('id', $id)->update(array_merge($fields, [
                'updated_by' => Auth::user()->id,
                'updated_at' => date('Y-m-d H:i:s')
            ]));
        } catch (\Exception $e) {
            throw $e; // Re-throw the exception to be caught by the service
        }
    }
}

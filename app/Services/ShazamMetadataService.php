<?php

namespace App\Services;

use App\Repositories\ShazamMetadataRepository;

class ShazamMetadataService {
    protected $shazamRepository;

    public function __construct(ShazamMetadataRepository $shazamRepository) {
        $this->shazamRepository = $shazamRepository;
    }

    public function getWithRelationship(): ?object {
        return $this->shazamRepository->fetchWithRelationship();
    }
}

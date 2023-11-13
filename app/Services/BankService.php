<?php

namespace App\Services;

use App\Repositories\BankRepository;

class BankService
{
    protected $bankRepository;

    public function __construct(
        BankRepository $bankRepository
    ) {
        $this->bankRepository = $bankRepository;
    }

    public function getListBank(): ?object
    {
        return $this->bankRepository->getListBank();
    }
}

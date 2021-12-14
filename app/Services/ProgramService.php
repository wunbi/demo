<?php

namespace App\Services;

use App\Repositories\ProgramRepository;


class ProgramService extends Service
{
    protected $repository;

    public function __construct(ProgramRepository $programRepository)
    {
        $this->repository = $programRepository;
    }
}

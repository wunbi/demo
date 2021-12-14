<?php

namespace App\Services;

use App\Repositories\UserGroupProgramRepository;


class UserGroupProgramService extends Service
{
    protected $repository;

    public function __construct(UserGroupProgramRepository $userGroupProgramRepo)
    {
        $this->repository = $userGroupProgramRepo;
    }
}

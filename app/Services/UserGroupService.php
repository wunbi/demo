<?php

namespace App\Services;

use App\Repositories\UserGroupRepository;


class UserGroupService extends Service
{
    protected $repository;

    public function __construct(UserGroupRepository $userGroupRepo)
    {
        $this->repository = $userGroupRepo;
    }
}

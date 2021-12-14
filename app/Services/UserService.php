<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\UserGroupRepository;


class UserService extends Service
{
    protected $repository;
    protected $userGroupRepo;

    public function __construct(UserRepository $taskRepo)
    {
        $this->repository = $taskRepo;
    }
}

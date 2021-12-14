<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService extends Service
{
    protected $repository;

    public function __construct(TaskRepository $taskRepo)
    {
        $this->repository = $taskRepo;
    }
}

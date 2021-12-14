<?php

/**
 * Created by PhpStorm.
 * User: twLeo.l
 * Date: 2019/4/3
 * Time: 下午 01:31
 */

namespace App\Services;

use App\Repositories\Repository;

class Service
{
    /**
     * @var Repository
     */
    protected $repository;

    /**
     * 取得所有集合
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function all(array $columns = ['*'])
    {
        return $this->repository->all($columns);
    }

    /**
     * @param array $columns select 栏位
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first(array $columns = ['*'])
    {
        return $this->repository->first($columns);
    }

    /**
     * @param $column string 栏位名称
     * @param $value string 值
     * @param array $columns select 栏位
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstBy($column, $value, array $columns = ['*'])
    {
        return $this->repository->firstBy($column, $value, $columns);
    }

    /**
     * @param array $columns select 栏位
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get($where = [], array $columns = ['*'])
    {
        return $this->repository->get($where, $columns);
    }

    public function new()
    {
        return $this->repository->new();
    }
}

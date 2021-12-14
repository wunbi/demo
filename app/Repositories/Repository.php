<?php

/**
 * Created by PhpStorm.
 * User: twLeo.l
 * Date: 2019/4/2
 * Time: 下午 06:45
 */

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

abstract class Repository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * 取得所有集合
     * @param array $columns
     * @return Collection|Model[]
     */
    public function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * @param array $columns select 栏位
     * @return Model
     */
    public function first(array $columns = ['*'])
    {
        return $this->model->first($columns);
    }

    /**
     * @param $column string 栏位名称
     * @param $value string 值
     * @param array $columns select 栏位
     * @return Model
     */
    public function firstBy($column, $value, array $columns = ['*'])
    {
        return $this->model->where($column, $value)->first($columns);
    }

    /**
     * @param array $columns select 栏位
     * @return Collection
     */
    public function get($where = [], array $columns = ['*'])
    {
        foreach ($where as $key => $value) {
            $this->model =  $this->model->where($key, $value);
        }

        return $this->model->get($columns);
    }

    public function new()
    {
        return new $this->model;
    }
}

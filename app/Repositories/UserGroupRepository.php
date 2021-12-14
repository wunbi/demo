<?php

namespace App\Repositories;

use App\Repositories\Repository;
use App\Models\UserGroup;

class UserGroupRepository extends Repository
{
    public function __construct(UserGroup $model)
    {
        $this->model = $model;
    }

    /**
     * 新增
     * @param array $request
     * @return boolean
     */
    public function insert($request)
    {
        foreach ($request->input() as $k => $v) {
            $this->model->$k = $v;
        }

        return $this->model->save();
    }

    /**
     * 查詢
     * @return Object
     */
    public function collect()
    {
        return $this->all();
    }

    /**
     * 查詢單筆
     * @param int $key_id
     * @return Object
     */
    public function collectBy($key_id)
    {
        return $this->firstBy('id', $key_id);
    }

    /**
     * 編輯
     * @param array $request
     * @param int $key_id
     * @return boolean
     */
    public function updateBy($request, $key_id)
    {
        $data = $this->collectBy($key_id);
        if (!$data) {
            return false;
        }

        foreach ($request->input() as $k => $v) {
            $data->$k = $v;
        }

        return $data->save();
    }

    /**
     * 編輯狀態
     * @param array $request
     * @param int $key_id
     * @return boolean
     */
    public function updateForStatus($request, $key_id)
    {
        $data = $this->collectBy($key_id);
        if (!$data) {
            return false;
        }

        $data->status = $request['status'];

        return $data->save();
    }
}

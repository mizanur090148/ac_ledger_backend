<?php

namespace App\Http\Controllers\Api\V1\Services;

class DropdownService
{
    /**
     * @param $modelName
     * @param array $where
     * @param array $select
     * @return mixed
     */
    public function dropdownData($modelName, $where = [], $select = [])
    {
        // Load model class object
        $model = new $modelName();
        // select column
        if (count($select)) {
            $model = $model->select($select);
        } else {
            $model = $model->select('*');
        }
        // where
        if (count($where)) {
            $model = $model->where($where);
        }
        $model = $model->orderBy('id', 'desc');

        return $model->get();
    }
}
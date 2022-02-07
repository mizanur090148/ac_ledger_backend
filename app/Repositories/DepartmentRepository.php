<?php


namespace App\Repositories;

use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Models\Settings\Department;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{

    /**
     * DepartmentRepository constructor.
     * @param Department $model
     */
    public function __construct(Department $model)
    {
        parent::__construct($model);
    }
}
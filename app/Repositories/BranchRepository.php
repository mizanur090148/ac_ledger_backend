<?php


namespace App\Repositories;

use App\Repositories\Interfaces\BranchRepositoryInterface;
use App\Models\Settings\Branch;

class BranchRepository extends BaseRepository implements BranchRepositoryInterface
{

    /**
     * BranchRepository constructor.
     * @param Branch $model
     */
    public function __construct(Branch $model)
    {
        parent::__construct($model);
    }
}
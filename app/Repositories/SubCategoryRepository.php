<?php


namespace App\Repositories;


use App\Repositories\Interfaces\SubCategoryRepositoryInterface;
use App\Models\Settings\SubCategory;

class SubCategoryRepository extends BaseRepository implements SubCategoryRepositoryInterface
{

    /**
     * SubCategoryRepository constructor.
     * @param SubCategory $model
     */
    public function __construct(SubCategory $model)
    {
        parent::__construct($model);
    }
}
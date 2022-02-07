<?php


namespace App\Repositories;

use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Models\Settings\Company;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
{

    /**
     * CompanyRepository constructor.
     * @param Company $model
     */
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }
}
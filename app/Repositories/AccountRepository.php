<?php


namespace App\Repositories;

use App\Repositories\Interfaces\AccountRepositoryInterface;
use App\Models\Settings\Account;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{

    /**
     * AccountRepository constructor.
     * @param Account $model
     */
    public function __construct(Account $model)
    {
        parent::__construct($model);
    }
}
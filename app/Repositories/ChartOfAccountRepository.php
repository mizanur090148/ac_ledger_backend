<?php


namespace App\Repositories;

use App\Repositories\Interfaces\ChartOfAccountRepositoryInterface;
use App\Models\ChartOfAccount;

class ChartOfAccountRepository extends BaseRepository implements ChartOfAccountRepositoryInterface
{

    /**
     * ChartOfAccountRepository constructor.
     * @param ChartOfAccount $model
     */
    public function __construct(ChartOfAccount $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $where
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function chartOfAccountList(array $where)
    {
        return ChartOfAccount::with('childChartOfAccounts')
            ->where($where)
            ->get();
    }
}
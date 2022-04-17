<?php


namespace App\Repositories;

use App\Repositories\Interfaces\ChartOfAccountRepositoryInterface;
use App\Models\ChartOfAccount;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

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
     * @return Builder[]|Collection
     */
    public function chartOfAccountList(array $where)
    {
        $result = ChartOfAccount::with('nodes')
            ->select('id','parent_id','ac_code','type','title as text')
            ->where($where);

        $assetQuery = clone $result;
        $equityQuery = clone $result;
        $liabilityQuery = clone $result;
        $incomeQuery = clone $result;
        $expenseQuery = clone $result;

        return [
            'assets'    => $assetQuery->where('type', 'assets')->get(),
            'equity'    => $equityQuery->where('type', 'equity')->get(),
            'liability' => $liabilityQuery->where('type', 'liability')->get(),
            'income'    => $incomeQuery->where('type', 'income')->get(),
            'expense'   => $expenseQuery->where('type', 'expense')->get(),
        ];
    }

    /**
     * @param Interfaces\int $id
     * @return mixed
     */
    public function chartOfAccountDelete($id)
    {
        $result = $this->model->find($id);
        if (empty($result)) {
            throw new NotFoundResourceException("No result found!");
        }
        $result->chartOfAccounts()->delete();
        return $result->delete();
    }

}
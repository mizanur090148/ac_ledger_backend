<?php


namespace App\Repositories\Interfaces;

interface ChartOfAccountRepositoryInterface extends BaseRepositoryInterface
{
    public function chartOfAccountList(array $where);
    public function chartOfAccountDelete($id);
}
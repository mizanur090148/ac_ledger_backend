<?php


namespace App\Repositories\Interfaces;

interface ChartOfAccountRepositoryInterface extends BaseRepositoryInterface
{
    public function chartOfAccountList(array $where);
}
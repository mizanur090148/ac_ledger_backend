<?php


namespace App\Repositories\Interfaces;

interface VoucherRepositoryInterface extends BaseRepositoryInterface
{
    public function voucherList($voucherType);
    public function storeVoucher(array $voucher, array $voucherDetails);
    public function updateVoucher($id, array$voucher, array $voucherDetails);
    public function deleteVoucher($id);
    public function getLastCreatedVoucher($voucherType);
}
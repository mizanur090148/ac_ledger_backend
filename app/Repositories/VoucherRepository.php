<?php


namespace App\Repositories;

use App\Repositories\Interfaces\VoucherRepositoryInterface;
use App\Models\Voucher;

class VoucherRepository extends BaseRepository implements VoucherRepositoryInterface
{

    /**
     * VoucherRepository constructor.
     * @param Voucher $model
     */
    public function __construct(Voucher $model)
    {
        parent::__construct($model);
    }

    public function voucherList($voucherType)
    {
        return $this->getModel()
            ->with('voucherDetails')
            ->when($voucherType, function ($query, $voucherType) {
                $query->where('voucher_type', $voucherType);
            })
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @param array $voucher
     * @param array $voucherDetails
     * @return mixed
     */
    public function storeVoucher(array $voucher, array $voucherDetails)
    {
        $voucher = $this->store($voucher);
        $voucher->voucherDetails()->createMany($voucherDetails);
        return $voucher->load('voucherDetails');
    }

    /**
     * @param $id
     * @param array $voucher
     * @param array $voucherDetails
     * @return mixed
     */
    public function updateVoucher($id, array $voucher, array $voucherDetails)
    {
        $voucherData = $this->find($id);
        $voucherData->update($voucher);
        $voucherData->voucherDetails()->delete();
        $voucherData->voucherDetails()->createMany($voucherDetails);
        return $voucherData->load('voucherDetails');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteVoucher($id)
    {
        $voucher = $this->find($id);
        $voucher->delete($id);
        return $voucher->voucherDetails()->delete();
    }

    /**
     * @param $voucherType
     * @return mixed
     */
    public function getLastCreatedVoucher($voucherType)
    {
        return $this->getModel()
            ->where('voucher_type', $voucherType)
            ->whereYear('created_date', date('Y'))
            ->orderByDesc('id')
            ->first();
    }
}
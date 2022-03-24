<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Services\DropdownService;
use App\Http\Controllers\Controller;
use App\Models\Settings\Company;
use App\Repositories\Interfaces\VoucherRepositoryInterface;
use App\Requests\VoucherRequest;
use Illuminate\Support\Str;
use DB;
use Request;

class VoucherController extends Controller
{
    /**
     * @var VoucherRepositoryInterface
     */
    protected $repository;

    /**
     * VoucherControllerController constructor.
     * @param VoucherRepositoryInterface $repository
     */
    public function __construct(VoucherRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\JsonResponse
     */
    public function index()
    {
        try {
            return responseSuccess($this->repository->voucherList(request('voucher_type')));
        } catch (Exception $e) {
        	return responseCantProcess($e);
        }
    }

    /**
     * @param VoucherRequest $request
     * @return \Illuminate\Http\JsonResponse|\JsonResponse
     */
    public function store(VoucherRequest $request)
    {
        try {
            DB::beginTransaction();
            $voucherDetails = $this->processVoucherInput($request);
            $result = $this->repository->storeVoucher($request->validated(), $voucherDetails);
            DB::commit();
            return responseCreated($result);
        } catch (Exception $e) {
            DB::rollback();
            return responseCantProcess($e);
        }
    }

    /**
     * @param $id
     * @param VoucherRequest $request
     * @return \JsonResponse
     */
    public function update($id, VoucherRequest $request)
    {
        try {
            DB::beginTransaction();
            $voucherDetails = $this->processVoucherInput($request);
            $result = $this->repository->updateVoucher($id, $request->validated(), $voucherDetails);
            DB::commit();
            return responsePatched($result);
        } catch (Exception $e) {
            return responseCantProcess($e);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\JsonResponse
     */
    public function delete($id)
    {
        try {
            $this->repository->deleteVoucher($id);
            return responseDeleted();
        } catch (Exception $e) {
            return responseCantProcess($e);
        }
    }

    /**
     * @param $request
     * @return array
     */
    public function processVoucherInput($request)
    {
        $voucherDetails = [];
        foreach ($request->account_balance as $key => $acBalance) {
            $voucherDetails[$key]['debit_to'] = $request->debit_to[$key] ?? null;
            $voucherDetails[$key]['credit_to'] = $request->credit_to[$key] ?? null;
            $voucherDetails[$key]['account_type'] = $request->account_type[$key] ?? null;
            $voucherDetails[$key]['account_head'] = $request->account_head[$key] ?? null;
            $voucherDetails[$key]['account_balance'] = $acBalance;
            $voucherDetails[$key]['description'] = $request->description[$key];
            $voucherDetails[$key]['con_rate'] = $request->con_rate[$key];
            $voucherDetails[$key]['fc_amount'] = $request->fc_amount[$key];
        }
        return $voucherDetails;
    }

    /**
     * @param DropdownService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function dropdownData(DropdownService $service)
    {
        $companies = $service->dropdownData(Company::class, [], ['id','name']);
        $result['companies'] = $companies;

        return responseSuccess($result);
    }

    public function newVoucherNo($voucherType)
    {
        $currentYear = date('Y');
        $lastVoucher = $this->repository->getLastCreatedVoucher($voucherType);
        if ($lastVoucher) {
            $newVoucherNo = (int) Str::substr($lastVoucher->voucher_no, ($voucherType == CONTRA) ? 9 : 8) + 1;
        } else {
            $newVoucherNo = 1;
        }
        if ($voucherType == DEBIT_OR_PAYMENT) {
            $newVoucherNo = 'DV-' . $currentYear . '-' . $newVoucherNo;
        } else if ($voucherType == CREDIT_OR_RECEIVED) {
            $newVoucherNo = 'CV-' . $currentYear . '-' . $newVoucherNo;
        } else if ($voucherType == CONTRA) {
            $newVoucherNo = 'CTV-' . $currentYear . '-' . $newVoucherNo;
        } else if ($voucherType == JOURNAL) {
            $newVoucherNo = 'JV-' . $currentYear . '-' . $newVoucherNo;
        }
        return responseSuccess($newVoucherNo);
    }

}

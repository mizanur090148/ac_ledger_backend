<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Services\DropdownService;
use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use App\Models\Settings\Branch;
use App\Repositories\Interfaces\ChartOfAccountRepositoryInterface;
use App\Requests\ChartOfAccountRequest;
use DB;

class ChartOfAccountController extends Controller
{
    /**
     * @var ChartOfAccountRepositoryInterface
     */
    protected $repository;

    /**
     * ChartOfAccountController constructor.
     * @param ChartOfAccountRepositoryInterface $repository
     */
    public function __construct(ChartOfAccountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\JsonResponse
     */
    public function index()
    {
        try {
            $where = [
                'parent_id' => null
            ];
            if (request('type')) {
                $where['type'] = request('type');
            }
            return responseSuccess($this->repository->chartOfAccountList($where));
        } catch (Exception $e) {
        	return responseCantProcess($e);
        }
    }

    /**
     * @param ChartOfAccountRequest $request
     * @return \Illuminate\Http\JsonResponse|\JsonResponse4
     */
    public function store(ChartOfAccountRequest $request)
    {
        try {
            DB::beginTransaction();
            $result = $this->repository->store($request->validated());
            DB::commit();
            return responseCreated($result);
        } catch (Exception $e) {
            DB::rollback();
            return responseCantProcess($e);
        }
    }

    /**
     * @param $id
     * @param ChartOfAccountRequest $request
     * @return \JsonResponse
     */
    public function update($id, ChartOfAccountRequest $request)
    {
        try {
            $result = $this->repository->update($id, $request->validated());
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
            $this->repository->chartOfAccountDelete($id);
            return responseDeleted();
        } catch (Exception $e) {
            return responseCantProcess($e);
        }
    }

    /**
     * @param null $payMode
     * @param DropdownService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function dropdown($payMode = null, DropdownService $service)
    {
        $branches = $service->chartOfAccountDropdownData(ChartOfAccount::class, $payMode);
        return responseSuccess($branches);
    }

    /**
     * @param DropdownService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function debitOrCreditToDropdown(DropdownService $service)
    {
        $branches = $service->debitOrCreditToDropdownData(ChartOfAccount::class);
        return responseSuccess($branches);
    }
}

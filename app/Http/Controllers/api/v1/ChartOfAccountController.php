<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\ChartOfAccount;
use App\Repositories\Interfaces\ChartOfAccountRepositoryInterface;
use App\Requests\ChartOfAccountRequest;

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
            return responseSuccess($this->repository->chartOfAccountList());
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
            $result = $this->repository->store($request->validated());
            return responseCreated($result);
        } catch (Exception $e) {
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

            $this->repository->delete($id);
            return responseDeleted();
        } catch (Exception $e) {
            return responseCantProcess($e);
        }
    }
}

<?php

namespace App\Http\Controllers\Api\V1\settings;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\Services\DropdownService;
use App\Models\Settings\Branch;
use App\Repositories\Interfaces\BranchRepositoryInterface;
use App\Requests\Settings\BranchRequest;
use Illuminate\Http\JsonResponse;
use JsonResponse4;


class BranchController extends Controller
{
    /**
     * @var BranchRepositoryInterface
     */
    protected $repository;

    /**
     * BranchController constructor.
     * @param BranchRepositoryInterface $repository
     */
    public function __construct(BranchRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return JsonResponse|\JsonResponse
     */
    public function index()
    {
        try {
            return responseSuccess($this->repository->paginate());
        } catch (Exception $e) {
        	return responseCantProcess($e);
        }
    }

    /**
     * @param BranchRequest $request
     * @return JsonResponse|JsonResponse4
     */
    public function store(BranchRequest $request)
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
     * @param BranchRequest $request
     * @return \JsonResponse
     */
    public function update($id, BranchRequest $request)
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
     * @return JsonResponse|\JsonResponse
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

    /**
     * @param $companyId
     * @param DropdownService $service
     * @return JsonResponse
     */
    public function dropdown($companyId = null, DropdownService $service)
    {
        $where = [];
        if ($companyId) {
            $where['company_id'] = $companyId;
        }
        $branches = $service->dropdownData(Branch::class, $where, ['id','name']);
        return responseSuccess($branches);
    }
}

<?php

namespace App\Http\Controllers\Api\V1\settings;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\BranchRepositoryInterface;
use App\Requests\Settings\BranchRequest;

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
     * @return \Illuminate\Http\JsonResponse|\JsonResponse
     */
    public function index()
    {
        try {
            return responseSuccess($this->repository->all());
        } catch (Exception $e) {
        	return responseCantProcess($e);
        }
    }

    /**
     * @param BranchRequest $request
     * @return \Illuminate\Http\JsonResponse|\JsonResponse4
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

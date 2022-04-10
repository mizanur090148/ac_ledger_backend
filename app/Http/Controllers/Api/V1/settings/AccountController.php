<?php

namespace App\Http\Controllers\Api\V1\settings;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AccountRepositoryInterface;
use App\Requests\Settings\AccountRequest;
use JsonResponse;
use JsonResponse4;

class AccountController extends Controller
{
    /**
     * @var AccountRepositoryInterface
     */
    protected $repository;

    /**
     * AccountController constructor.
     * @param AccountRepositoryInterface $repository
     */
    public function __construct(AccountRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse|JsonResponse
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
     * @param AccountRequest $request
     * @return \Illuminate\Http\JsonResponse|JsonResponse4
     */
    public function store(AccountRequest $request)
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
     * @param AccountRequest $request
     * @return JsonResponse
     */
    public function update($id, AccountRequest $request)
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
     * @return \Illuminate\Http\JsonResponse|JsonResponse
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

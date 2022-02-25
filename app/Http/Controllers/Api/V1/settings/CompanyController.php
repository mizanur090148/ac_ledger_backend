<?php

namespace App\Http\Controllers\Api\V1\settings;

use App\Http\Controllers\Api\V1\Services\DropdownService;
use App\Http\Controllers\Controller;
use App\Models\Settings\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Requests\Settings\CompanyRequest;

class CompanyController extends Controller
{
    /**
     * @var CompanyRepositoryInterface
     */
    protected $repository;

    /**
     * CompanyController constructor.
     * @param CompanyRepositoryInterface $repository
     */
    public function __construct(CompanyRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\JsonResponse
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
     * @param CompanyRequest $request
     * @return \Illuminate\Http\JsonResponse|\JsonResponse4
     */
    public function store(CompanyRequest $request)
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
     * @param CompanyRequest $request
     * @return \JsonResponse
     */
    public function update($id, CompanyRequest $request)
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

    /**
     * @param DropdownService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function dropdown(DropdownService $service)
    {
        $companies = $service->dropdownData(Company::class, [], ['id','name']);
        return responseSuccess($companies);
    }
}

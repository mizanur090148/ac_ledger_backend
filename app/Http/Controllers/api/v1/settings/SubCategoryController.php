<?php

namespace App\Http\Controllers\api\v1\settings;

use App\Repositories\Interfaces\SubCategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController as BaseController;
use App\Requests\Settings\SubCategoryRequest;

class SubCategoryController extends BaseController
{
    protected $repository;

    public function __construct(SubCategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $result = $this->repository->all();
            return responseSuccess($result);
        } catch (Exception $e) {
            return responseCantProcess($e);
        }
    }

    public function store(SubCategoryRequest $request)
    {
        try {
            $result = $this->repository->store($request->validated());
            return responseCreated($result);
        } catch (Exception $e) {
            return responseCantProcess($e);
        }
    }

    public function update($id, SubCategoryRequest $request)
    {
        try {
            $result = $this->repository->update($id, $request->validated());
            return responsePatched($result);
        } catch (Exception $e) {
            return responseCantProcess($e);
        }
    }

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

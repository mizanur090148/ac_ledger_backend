<?php

namespace App\Http\Controllers\api\v1\settings;

use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController as BaseController;
use App\Requests\Settings\DepartmentRequest;

class DepartmentController extends BaseController
{
    protected $repository;

    public function __construct(DepartmentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            return responseSuccess($this->repository->all());
        } catch (Exception $e) {
            return responseCantProcess($e);
        }
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $result = $this->repository->store($request->validated());
            return responseCreated($result);
        } catch (Exception $e) {
            return responseCantProcess($e);
        }
    }

    public function update($id, DepartmentRequest $request)
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

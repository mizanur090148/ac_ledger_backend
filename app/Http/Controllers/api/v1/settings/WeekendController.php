<?php

namespace App\Http\Controllers\api\v1\settings;

use App\Http\Controllers\api\v1\ApiCrudHandler;
use App\Http\Controllers\api\v1\BaseController;
use App\Models\Settings\Weekend;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeekendController extends BaseController
{
    protected $apiCrudHandler;

    public function __construct(ApiCrudHandler $apiCrudHandler)
    {
        $this->apiCrudHandler = $apiCrudHandler;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            $modelData = $this->apiCrudHandler->index($request, Weekend::class);
            return $this->sendResponse($modelData);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id): Response
    {
        try {
            $modelData = $this->apiCrudHandler->show($id, Weekend::class);
            return $this->sendResponse($modelData->pluck('weekend_day_name')->all());
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        try {
            // TODO
            //return $request->all();
            //$modelData = $this->apiCrudHandler->show($id, Weekend::class);
            return $this->sendResponse(true);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}

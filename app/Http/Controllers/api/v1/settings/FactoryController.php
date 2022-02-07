<?php

namespace App\Http\Controllers\api\v1\settings;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\api\v1\BaseController as BaseController;
use App\Http\Controllers\api\v1\ApiCrudHandler;
use App\Requests\Settings\FactoryRequest;
use App\Requests\Settings\FactoryLogoRequest;
use App\Models\Factory;
use Validator;

class FactoryController extends BaseController
{
    protected $apiCrudHandler;

    public function __construct(ApiCrudHandler $apiCrudHandler)
    {
        $this->apiCrudHandler = $apiCrudHandler;
    }

    public function index(Request $request)
    {
        try {
            $modelData = $this->apiCrudHandler->index($request, Factory::class);
            return $this->sendResponse($modelData);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     *
     * @param FactoryRequest $request
     * @return Array
     */
    public function store(FactoryRequest $request)
    {
        try {
            $modelData = $this->apiCrudHandler->store($request, Factory::class);
            return $this->responseOk($modelData);
        } catch (Exception $ex) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * @param FactoryLogoRequest $request
     */
    public function updateCompanyLogo($id, FactoryLogoRequest $request)
    {
        try {
            // file upload
            if ($request->hasFile('logo')) {
                $destinationPath = 'public/logo';
                $logo = $request->file('logo');
                $imageName = time().'.'.$logo->getClientOriginalExtension();
                $dbStoreName = 'storage/logo/'.$imageName;
                $logo->storeAs($destinationPath, $imageName);
                $input['logo'] =  $dbStoreName;
                $request = new \Illuminate\Http\Request($input);
            }
            $modelData = $this->apiCrudHandler->update($id, $request, Factory::class);
            return $this->sendResponse($modelData);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     *
     * @param Request $request
     * @return Array
     */
    public function groupStore(Request $request)
    {
        try {
            $group = Group::create($request->all());
            return $this->sendResponse($group);
        } catch (Exception $ex) {dd(99);
            return $this->sendError($e->getMessage());
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $with = ['group'];
            $modelData = $this->apiCrudHandler->show($id, Factory::class, $with);
            return $this->sendResponse($modelData);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $delete = $this->apiCrudHandler->delete($id, Factory::class);
            return $this->sendResponse($delete);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }
}

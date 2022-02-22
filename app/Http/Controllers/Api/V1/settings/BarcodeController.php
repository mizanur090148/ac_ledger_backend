<?php

namespace App\Http\Controllers\Api\V1\settings;

use App\Http\Controllers\Api\V1\ApiCrudHandler;
use App\Models\Settings\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Requests\Settings\CategoryRequest;
use Validator;

class BarcodeController extends BaseController
{
    public function index(Request $request)
    {
        try {
        	$subCategories = SubCategory::with('category')->get();
        	return $this->sendResponse($subCategories);
        } catch (Exception $e) {
        	return $this->sendError($e->getMessage());
        }
    }
}

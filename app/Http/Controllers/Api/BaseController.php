<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return Response
     */
    public function sendResponse($result)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => 'Operation successful',
        ];

        return response()->json($response, 200);
    }

    /**
     * @param null $data
     * @param string $message
     * @return JsonResponse
     */
    public function responseOk($data = null, $message = "Request processed successfully"): JsonResponse
    {
//        $response = [
//            'success' => true,
//            'message' => $message
//        ];
//
//        if ($data) {
//            $response['data'] = $data;
//        }
        //return response()->json($response, 200);
        return response()->json($data ?: 'OK');
    }

    /**
     * @param null $data
     * @param null $message
     * @return JsonResponse
     */
    public function responseCreated($data = null, $message = null): JsonResponse
    {
        $response = [
            'status' => 201,
            'success' => true,
            'message' => $message ?: 'Record created successfully'
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response, 201);
    }

    /**
     * @return JsonResponse
     */
    public function responseDeleted(): JsonResponse
    {
        $response = [
            'status' => 200,
            'success' => true,
            'message' => 'Record deleted successfully'
        ];
        return response()->json($response);
    }

    public function responseCantProcess(Throwable $t = null, string $message = null): JsonResponse
    {
        $response = [
            'status' => $t ? $t->getCode() : null,
            'success' => false,
            'message' => $message ?? ((config('app.debug') && $t)
                    ? $t->getMessage() . '. Location : ' . $t->getFile() . ' at line : ' . $t->getLine()
                    : 'Cannot process request')
        ];
        return response()->json($response, 400);
    }

    public function responseNotFound($message = 'Not Found!'): JsonResponse
    {
        $response = [
            'status' => 404,
            'success' => false,
            'message' => $message
        ];
        return response()->json($response, 404);
    }

    /**
     * return error response.
     *
     * @return Response
     */
    public function sendError($error)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        return response()->json($response, 500);
    }
}

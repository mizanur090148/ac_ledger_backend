<?php

if (!function_exists('factoryId')) {
    function factoryId()
    {
        Auth::user()->factory_id ?? null;
    }
}
if (!function_exists('responseCreated')) {
    /**
     * @param null $data
     * @param null $message
     */
    function responseCreated($data = null, $message = null)
    {
        $response = [
            'status' => 201,
            'success' => true,
            'message' => $message ?? 'Record created successfully'
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response, 201);
    }
}

if (!function_exists('responsePatched')) {
    /**
     * @param null $data
     * @return JsonResponse
     */
    function responsePatched($data = null)
    {
        $response = [
            'status' => 200,
            'success' => true,
            'message' => 'Record updated successfully'
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return response()->json($response);
    }
}

if (!function_exists('responseDeleted')) {
    function responseDeleted()
    {
        $response = [
            'status' => 200,
            'success' => true,
            'message' => 'Record deleted successfully'
        ];
        return response()->json($response);
    }
}

if (!function_exists('responseCantProcess')) {
    /**
     * @param Throwable|null $t
     * @param string|null $message
     * @return JsonResponse
     */
    function responseCantProcess(Throwable $t = null, string $message = null): JsonResponse
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
}

if (!function_exists('responseUnauthorized')) {
    /**
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    function responseUnauthorized(string $message = 'Unauthorized', int $status = 401): JsonResponse
    {
        $response = [
            'status' => $status,
            'success' => false,
            'message' => $message
        ];
        return response()->json($response, $status);
    }
}

if (!function_exists('responseContactAdmin')) {
    /**
     * @param $message
     * @return JsonResponse
     */
    function responseContactAdmin($message): JsonResponse
    {
        $response = [
            'status' => 400,
            'success' => false,
            'message' => $message
        ];
        return response()->json($response, 400);
    }
}

if (!function_exists('responseNotFound')) {
    /**
     * @param string $message
     * @return JsonResponse
     */
    function responseNotFound($message = 'Not Found!'): JsonResponse
    {
        $response = [
            'status' => 404,
            'success' => false,
            'message' => $message
        ];
        return response()->json($response, 404);
    }
}

if (!function_exists('responseSuccess')) {
    /**
     * @param null $data
     * @param string $message
     */
    function responseSuccess($data = null, $message = "Request processed successfully")
    {
        $response = [
            'success' => true,
            'message' => $message
        ];

        if ($data || is_array($data)) {
            $response['data'] = $data;
        }
        return response()->json($response, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
    }
}
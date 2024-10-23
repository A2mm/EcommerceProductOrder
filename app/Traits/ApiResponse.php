<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * @param $data
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    protected function successResponse($data, int $code = 200, $message = null): JsonResponse
    {
        return response()->json([
            'status' => "success",
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    protected function errorResponse($error, int $code, $message = null): JsonResponse
    {
        return response()->json([
            'status' => "Error",
            'message' => $message,
            'error' => $error
        ], $code);
    }
}

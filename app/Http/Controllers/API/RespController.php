<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;

trait RespController
{
    /**
     * Success response
     *
     * @param mixed  $data
     * @param string $message
     * @param int    $status
     * @return JsonResponse
     */
    protected function successResponse($data, $message = 'Success', $status = 200): JsonResponse
    {
        return response()->json(
            array(
                'status'  => 'success',
                'message' => $message,
                'data'    => $data,
            ),
            $status
        );
    }

    /**
     * Error response
     *
     * @param string $message
     * @param int    $status
     * @param mixed  $data
     * @return JsonResponse
     */
    protected function errorResponse($message, $status = 400, $data = null): JsonResponse
    {
        return response()->json(
            array(
                'status'  => 'error',
                'message' => $message,
                'data'    => $data,
            ),
            $status
        );
    }
}

<?php

namespace App\Helper;

class ResponseHelper
{
    // /**
    //  * Create a new class instance.
    //  */
    // public function __construct()
    // {
    //     //
    // }

    /**
     * success response in list format
     * @param mixed $status
     * @param mixed $message
     * @param mixed $data
     * @param mixed $statusCode
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public static function success(
        $status = 'success',
        $message = null,
        // $token = null,
        $data = [],
        $statusCode = 200,
        
    ) {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $data,
            // 'token' => $token,
        ], $statusCode);
    }

    /**
     * error response message
     * @param mixed $status
     * @param mixed $message
     * @param mixed $statusCode
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public static function error(
        $status = "error",
        $message = null,
        $statusCode = 400,
    ) {
        return response()->json([
            "status" => $status,
            "message" => $message,
        ], $statusCode);
    }
}

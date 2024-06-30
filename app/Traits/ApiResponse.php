<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Prepare a standardized JSON response.
     *
     * @param int $code The HTTP status code
     * @param bool $success Indicates the success status of the response
     * @param mixed $data The data to be returned in the response
     * @param string $message A message describing the result
     * @param mixed $error Additional error information, if any
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(int $code, bool $success, $data = null, string $message = '', $error = null): JsonResponse
    {
        // Ensure that the error is an array or null
        if (!is_array($error) && $error !== null) {
            $error = [$error];
        }

        return response()->json([
            'success' => $success,
            'data' => $data,
            'message' => $message,
            'error' => $error,
        ], $code);
    }
}

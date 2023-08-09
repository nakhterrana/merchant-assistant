<?php

namespace App\Http\Traits;

use Symfony\Component\HttpFoundation\Response;


trait ApiResponder
{
    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data, string $message = null, int $responseCode = Response::HTTP_OK, int $code = Response::HTTP_OK)
    {
        return response()->json([
            'success' => true,
            'code' => $responseCode,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(string $message = null, int $code, $error = [])
    {
        return response()->json([
            'success' => false,
            'code' => $code,
            'message' => $message,
            'data' => [],
            'error' => $error,
        ], $code);
    }
}

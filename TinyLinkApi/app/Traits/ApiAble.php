<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiAble
{

    /**
     * Success Response
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $code
     * @return JsonResponse
     */
    protected function successResponse(mixed $data = [], ?string $message = null, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => $message,
            'code' => $code,
        ], $code);
    }

    /**
     * Error Response
     *
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $code = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'code' => $code,
            'data' => null
        ], $code);
    }


    /**
     * Paginated Response
     *
     * @param $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    protected function paginatedResponse($data, string $message, int $code): JsonResponse
    {
        $payload = $data->response()->getData(true);

        return response()->json([
            'data' => $payload['data'] ?? [],
            'links' => $payload['links'] ?? null,
            'meta' => $payload['meta'] ?? null,
            'message' => $message,
            'code' => $code,
        ], $code);
    }
}

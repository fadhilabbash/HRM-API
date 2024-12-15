<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponses
{
    /**
     * Success Response.
     *
     * @param  mixed  $data
     * @param  string  $message
     * @param  int  $statusCode
     * @return JsonResponse
     */
    public function successResponse(mixed $data = null, string $message = 'Success', int $statusCode = Response::HTTP_OK, array $pagination = null): JsonResponse
    {
        $response = [
           'type' => 'success',
            'message' => $message,
            'data' => $data,
        ];

        if ($pagination) {
            $response['pagination'] = $pagination;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Error Response.
     *
     * @param  mixed  $errors
     * @param  string  $message
     * @param  int  $statusCode
     * @return JsonResponse
     */
    public function errorResponse(mixed $errors = null, string $message = 'Error', int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json([
            'type' => 'error',
            'message' => $message ?: Response::$statusTexts[$statusCode],
            'errors' => $errors,
        ], $statusCode);
    }

    /**
     * Response with status code 200.
     *
     * @param  mixed  $data
     * @param  string  $message
     * @return JsonResponse
     */
    public function okResponse(mixed $data, string $message = 'OK'): JsonResponse
    {
        return $this->successResponse($data, $message);
    }

    /**
     * Response with status code 201.
     *
     * @param  mixed  $data
     * @param  string  $message
     * @return JsonResponse
     */
    public function createdResponse(mixed $data, string $message = 'Created'): JsonResponse
    {
        return $this->successResponse($data, $message, Response::HTTP_CREATED);
    }

    /**
     * Response with status code 204.
     *
     * @param  string  $message
     * @return JsonResponse
     */
    public function noContentResponse(string $message = 'No Content'): JsonResponse
    {
        return response()->json([
           'type' => 'no_content',
            'message' => $message,
            'data' => null,
        ], Response::HTTP_NO_CONTENT);
    }

    /**
     * Response with status code 400.
     *
     * @param  mixed  $errors
     * @param  string  $message
     * @return JsonResponse
     */
    public function badRequestResponse(mixed $errors, string $message = 'Bad Request'): JsonResponse
    {
        return $this->errorResponse($errors, $message, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Response with status code 401.
     *
     * @param  mixed  $errors
     * @param  string  $message
     * @return JsonResponse
     */
    public function unauthorizedResponse(mixed $errors, string $message = 'Unauthorized'): JsonResponse
    {
        return $this->errorResponse($errors, $message, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Response with status code 403.
     *
     * @param  mixed  $errors
     * @param  string  $message
     * @return JsonResponse
     */
    public function forbiddenResponse(mixed $errors, string $message = 'Forbidden'): JsonResponse
    {
        return $this->errorResponse($errors, $message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Response with status code 404.
     *
     * @param  mixed  $errors
     * @param  string  $message
     * @return JsonResponse
     */
    public function notFoundResponse(mixed $errors, string $message = 'Not Found'): JsonResponse
    {
        return $this->errorResponse($errors, $message, Response::HTTP_NOT_FOUND);
    }

    /**
     * Response with status code 409.
     *
     * @param  mixed  $errors
     * @param  string  $message
     * @return JsonResponse
     */
    public function conflictResponse(mixed $errors, string $message = 'Conflict'): JsonResponse
    {
        return $this->errorResponse($errors, $message, Response::HTTP_CONFLICT);
    }

    /**
     * Response with status code 422.
     *
     * @param  mixed  $errors
     * @param  string  $message
     * @return JsonResponse
     */
    public function unprocessableResponse(mixed $errors, string $message = 'Unprocessable Entity'): JsonResponse
    {
        return $this->errorResponse($errors, $message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}

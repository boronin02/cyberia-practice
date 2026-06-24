<?php

namespace Pkg\WebApp\v1\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @deprecated Use `App\Http\Controllers\API\Controller`.
 */
class Api
{
    public static function success(?string $message = null, array|Collection|null|JsonResource $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('api.base.success'),
            'data' => $data,
        ]);
    }

    public static function unauthenticated(?string $message = null, ?array $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('api.base.unauthenticated'),
            'data' => $data,
        ], 401);
    }

    public static function unauthorized(?string $message = null, ?array $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('api.base.unauthorized'),
            'data' => $data,
        ], 403);
    }

    public static function notFound(?string $message = null, ?array $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('api.base.not_found'),
            'data' => $data,
        ], 404);
    }

    public static function unprocessableEntity(?string $message = null, ?array $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('api.base.unprocessable_entity'),
            'errors' => $data,
        ], 422);
    }

    public static function internalError(string $message, array $data = []): JsonResponse
    {
        return response()->json([
            'message' => $message ?? __('api.base.internal_error'),
            'data' => $data,
        ], 500)->send();
    }

    public static function response(string $message, array $data = [], $status = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => (object) $data,
        ], $status);
    }

    public static function redirect(string $path): RedirectResponse
    {
        return response()->redirectTo(
            $path
        );
    }
}

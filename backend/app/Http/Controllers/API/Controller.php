<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

abstract class Controller extends BaseController
{
    public function successful(
        ?string                $message = null,
        Responsable|array|null $data = null,
    ): JsonResponse {
        return response()->json([
            'message' => $message ?? __('api.base.success'),
            'data' => $data,
        ]);
    }
}

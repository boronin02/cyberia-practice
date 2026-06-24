<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Author\AuthorResource;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Pkg\WebApp\v1\Helpers\Api;

class AuthorController extends Controller
{
    public function __construct(
    ) {
    }

    public function show(Author $author): JsonResponse
    {
        return Api::success(
            __('api.base.success'),
            (new AuthorResource($author))->toArray(request())
        );
    }
}

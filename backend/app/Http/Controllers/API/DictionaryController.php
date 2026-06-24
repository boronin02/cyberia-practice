<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Dictionaries\DictionaryRequest;
use App\Http\Resources\Dictionaries\DictionaryResource;
use Illuminate\Http\JsonResponse;
use Pkg\WebApp\v1\Helpers\Api;

class DictionaryController extends Controller
{
    public function index(DictionaryRequest $request): JsonResponse
    {
        return Api::success(
            __('api.base.success'),
            new DictionaryResource($request->getDictionaries())
        );
    }
}

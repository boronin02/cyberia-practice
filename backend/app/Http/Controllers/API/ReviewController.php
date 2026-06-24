<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\IndexReviewRequest;
use App\Http\Resources\Review\ReviewResource;
use Illuminate\Http\JsonResponse;
use Pkg\WebApp\v1\Helpers\Paginated;

class ReviewController extends Controller
{
    public function index(IndexReviewRequest $request): JsonResponse
    {
        return $this->successful(
            message: __('api.base.success'),
            data: Paginated::paginate(
                $request->getPage(),
                $request->getPerPage(),
                $request->getModels(),
                ReviewResource::class,
            ),
        );
    }
}

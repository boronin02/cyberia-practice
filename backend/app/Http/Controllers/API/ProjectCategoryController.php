<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ProjectCategories\ProjectCategoryIndexResource;
use App\Repositories\ProjectCategoryRepository;
use Illuminate\Http\JsonResponse;

final class ProjectCategoryController extends Controller
{
    public function index(ProjectCategoryRepository $repository): JsonResponse
    {
        $items = $repository->getProjectCategories();

        return $this->successful(
            message: __('api.base.success'),
            data: ProjectCategoryIndexResource::collection($items),
        );
    }
}

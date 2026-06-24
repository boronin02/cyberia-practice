<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Projects\IndexProjectRequest;
use App\Http\Requests\API\Projects\RelatedProjectRequest;
use App\Http\Resources\Awards\AwardResource;
use App\Http\Resources\Project\ProjectIndexResource;
use App\Http\Resources\Project\ProjectShowResource;
use App\Http\Resources\Sitemaps\SitemapResource;
use App\Repositories\AwardRepository;
use App\Repositories\ProjectRepository;
use App\Support\Pagination\PaginationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectRepository $projectRepository,
        private readonly AwardRepository $awardRepository,
    ) {
    }

    /**
     * @response array{
     *  message: string,
     *  data: array{
     *      pagination: App\Support\Pagination\PaginationMetaResource,
     *      items: ProjectIndexResource[]
     *  }
     * }
     *
     * @unauthenticated
     */
    public function index(IndexProjectRequest $request): JsonResponse
    {
        $items = $request
            ->filter($request->sort($this->projectRepository->forIndex()))
            ->paginate(
                perPage: $request->getPagination()->perPage,
                page: $request->getPagination()->page
            );

        return $this->successful(
            data: PaginationResource::make($items, ProjectIndexResource::class),
        );
    }

    public function listForSitemap(Request $request): JsonResponse
    {
        $items = $this->projectRepository->listForSitemap();

        return $this->successful(
            data: [
                'items' => SitemapResource::collection($items),
            ],
        );
    }

    /**
     * @unauthenticated
     */
    public function show(string $slug): JsonResponse
    {
        $project = $this->projectRepository->forShow($slug);
        $awards = $this->awardRepository->getAwardsByProjectId($project->id);

        return $this->successful(
            data: [
                'project' => ProjectShowResource::make($project),
                'awards' => AwardResource::collection($awards),
            ]
        );
    }

    /**
     * @response array{
     *  message: string,
     *  data: array{
     *      pagination: App\Support\Pagination\PaginationMetaResource,
     *      items: ProjectIndexResource[]
     *  }
     * }
     *
     * @unauthenticated
     */
    public function related(RelatedProjectRequest $request, string $slug): JsonResponse
    {
        $project = $this->projectRepository->forShow($slug);

        $items = $this
            ->projectRepository
            ->forRelated($project)
            ->paginate(
                perPage: $request->getPagination()->perPage,
                page: $request->getPagination()->page
            );

        return $this->successful(
            data: PaginationResource::make($items, ProjectIndexResource::class),
        );
    }
}

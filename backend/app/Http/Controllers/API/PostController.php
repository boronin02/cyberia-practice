<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Posts\IndexPostRequest;
use App\Http\Resources\Post\PostPreviewResource;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Sitemaps\SitemapResource;
use App\Repositories\PostRepository;
use App\Support\Pagination\PaginationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PostController extends Controller
{
    public function index(IndexPostRequest $request, PostRepository $repository): JsonResponse
    {
        $items = $request
            ->filter($request->sort($repository->forIndex()))
            ->paginate(
                perPage: $request->getPagination()->perPage,
                page: $request->getPagination()->page
            );

        return $this->successful(
            message: __('api.base.success'),
            data: PaginationResource::make($items, PostPreviewResource::class),
        );
    }

    public function listForSitemap(Request $request, PostRepository $repository): JsonResponse
    {
        $blogs = $repository->listBlogsForSitemap();
        $news = $repository->listNewsForSitemap();

        return $this->successful(
            data: [
                'items' => [
                    'blogs' => SitemapResource::collection($blogs),
                    'news' => SitemapResource::collection($news),
                ],
            ],
        );
    }

    public function show(string $postSlug, PostRepository $repository): JsonResponse
    {
        $item = $repository->forShow($postSlug);

        return $this->successful(
            message: __('api.base.success'),
            data: PostResource::make($item),
        );
    }
}

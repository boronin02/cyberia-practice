<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Tags\TagResource;
use App\Repositories\TagRepository;
use Illuminate\Http\JsonResponse;

final class TagController extends Controller
{
    public function __construct(
        private readonly TagRepository $repository
    ) {
    }

    /**
     * @response array{
     *  message: string,
     *  data: array{
     *      tags: TagResource[]
     *  }
     * }
     *
     * @unauthenticated
     */
    public function index(): JsonResponse
    {
        $items = $this->repository->getTags();

        return $this->successful(
            data: [
                'tags' => TagResource::collection($items),
            ]
        );
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Awards\AwardResource;
use App\Repositories\AwardRepository;
use Illuminate\Http\JsonResponse;

final class AwardController extends Controller
{
    public function __construct(
        private readonly AwardRepository $repository
    ) {
    }

    /**
     * @response array{
     *  message: string,
     *  data: array{
     *      awards: AwardResource[]
     *  }
     * }
     *
     * @unauthenticated
     */
    public function index(): JsonResponse
    {
        $items = $this->repository->getAwards();

        return $this->successful(
            data: [
                'awards' => AwardResource::collection($items),
            ]
        );
    }
}

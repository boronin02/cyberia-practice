<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\Banners\BannerIndexResource;
use App\Repositories\BannerRepository;
use Illuminate\Http\JsonResponse;

final class BannerController extends Controller
{
    public function index(BannerRepository $repository): JsonResponse
    {
        $items = $repository->getBanners();

        return $this->successful(
            message: __('api.base.success'),
            data: BannerIndexResource::collection($items),
        );
    }
}

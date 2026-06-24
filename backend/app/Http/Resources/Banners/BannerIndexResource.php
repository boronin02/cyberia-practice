<?php

namespace App\Http\Resources\Banners;

use App\Http\Resources\Media\MediaResource;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Banner $resource
 */
final class BannerIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $resource = $this->resource;

        return [
            'id' => $resource->id,
            'title' => $resource->title,
            'description' => $resource->description,
            'banner_desktop' => $this->when(
                condition: filled($resource->desktopBanner),
                value: MediaResource::make($resource->desktopBanner),
                default: null,
            ),
            'banner_mobile' => $this->when(
                condition: filled($resource->mobileBanner),
                value: MediaResource::make($resource->mobileBanner),
                default: null,
            ),
        ];
    }
}

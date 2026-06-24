<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Media\MediaResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Project $resource
 */
class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'price' => $this->resource->price,
            'time' => $this->resource->time,
            'image' => $this->resource->image?->getUrl(),
            'image_mobile' => $this->resource->imageMobile?->getUrl(),
            'video_cover' => $this->resource->videoCover
                ? MediaResource::make($this->resource->videoCover)
                : null,
            'link' => $this->resource->link,
            'is_big' => $this->resource->is_big,
        ];
    }
}

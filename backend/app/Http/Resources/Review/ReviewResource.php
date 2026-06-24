<?php

namespace App\Http\Resources\Review;

use App\Http\Resources\Media\MediaResource;
use App\Http\Resources\Project\ProjectResource;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property Review $resource
 */
class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $resource = $this->resource;

        return [
            'id' => $resource->id,
            'fio' => $resource->fio,
            'position' => $resource->position,
            'content' => $resource->content,
            'document' => $resource->getReviewDocument()?->getUrl(),
            'image' => $this->when(
                condition: $resource->getReviewImage() instanceof Media,
                value: MediaResource::make($resource->getReviewImage()),
                default: null,
            ),
            'project' => ProjectResource::make($this->resource->project),
        ];
    }
}

<?php

namespace App\Http\Resources\Media;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @property Media $resource
 */
class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->resource->uuid,
            'mime_type' => $this->resource->mime_type,
            'original_url' => $this->resource->getUrl(),
            'preview_url' => $this->resource->hasGeneratedConversion('thumb')
                ? $this->resource->getUrl('thumb')
                : null,
        ];
    }
}

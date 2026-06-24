<?php

namespace App\Http\Resources\Author;

use App\Models\Author;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Author $resource
 */
class AuthorDictionaryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'full_name' => $this->resource->full_name,
        ];
    }
}

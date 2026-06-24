<?php

namespace App\Http\Resources\ProjectCategories;

use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property ProjectCategory $resource
 */
class ProjectCategoryIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $resource = $this->resource;

        return [
            'id' => $resource->id,
            'name' => $resource->name,
        ];
    }
}

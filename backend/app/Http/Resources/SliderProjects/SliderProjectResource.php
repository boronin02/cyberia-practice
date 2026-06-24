<?php

namespace App\Http\Resources\SliderProjects;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SliderProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'chips' => $this->resource->chips,
            'link' => $this->resource->link,
            'image' => $this->resource->getUrlImage,
            'order' => $this->resource->order,
        ];
    }
}

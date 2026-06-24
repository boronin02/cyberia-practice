<?php

namespace App\Http\Resources\Tags;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Tag $resource
 */
final class TagResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            /**
             * ID тега.
             *
             * @var int
             *
             * @example 1
             */
            'id' => $this->resource->id,

            /**
             * Название тега.
             *
             * @var string
             *
             * @example Программирование
             */
            'name' => $this->resource->name,

            /**
             * Количество постов для отображения в бейдже тега.
             *
             * @var int
             *
             * @example 1
             */
            'posts_count' => $this->whenHas('posts_count'),
        ];
    }
}

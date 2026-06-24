<?php

namespace App\Http\Resources\Author;

use App\Models\Author;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Author $resource
 */
class AuthorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [

            /**
             * ID автора.
             *
             * @var int
             *
             * @example 1
             */
            'id' => $this->resource->id,

            /**
             * Фамилия автора.
             *
             * @var string
             *
             * @example Иванов
             */
            'last_name' => $this->resource->last_name,

            /**
             * Имя автора.
             *
             * @var string
             *
             * @example Иван
             */
            'first_name' => $this->resource->first_name,

            /**
             * Ссылка на аватар автора.
             *
             * @var string
             *
             * @example https://example.com
             */
            'image' => $this->resource->image_url,

            /**
             * Должности автора.
             *
             * @var array
             *
             * @example []
             */
            'positions' => $this->whenLoaded(
                'positions',
                $this->resource->positions->pluck('name'),
            ),
        ];
    }
}

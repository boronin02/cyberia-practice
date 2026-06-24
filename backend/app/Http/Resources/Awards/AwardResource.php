<?php

namespace App\Http\Resources\Awards;

use App\Http\Resources\Media\MediaResource;
use App\Http\Resources\Project\ProjectIndexResource;
use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Award $resource
 */
final class AwardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            /**
             * ID награды.
             *
             * @var int
             *
             * @example 1
             */
            'id' => $this->resource->id,

            /**
             * Заголовок награды.
             *
             * @var string
             *
             * @example Рейтинг рунета
             */
            'title' => $this->resource->title,

            /**
             * Описание награды.
             *
             * @var string|null
             *
             * @example Самая перспективная студия до 30 человек
             */
            'description' => $this->resource->description,

            /**
             * Изображение награды.
             *
             * @var MediaResource
             */
            'award_image' => MediaResource::make($this->resource->awardImage),

            /**
             * Иконка награды.
             *
             * @var MediaResource
             */
            'award_icon' => MediaResource::make($this->resource->awardIcon),

            /**
             * Проект
             *
             * @var ProjectIndexResource
             */
            'project' => ProjectIndexResource::make($this->whenLoaded('project')),
        ];
    }
}

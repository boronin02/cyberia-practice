<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Media\MediaResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Project $resource
 */
class ProjectShowResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            /**
             * ID проекта
             *
             * @var int
             *
             * @example 1
             */
            'id' => $this->resource->id,

            /**
             * Заголовок проекта
             *
             * @var string
             *
             * @example Проект 1
             */
            'title' => $this->resource->title,

            /**
             * Описание проекта
             *
             * @var string
             *
             * @example Описание...
             */
            'description' => $this->resource->description,

            /**
             * Цена
             *
             * @var int
             *
             * @example 100
             */
            'price' => $this->resource->price,

            /**
             * Время
             *
             * @var string|null
             *
             * @example 01.01.2025
             */
            'time' => $this->resource->time,

            /**
             * Изображение
             *
             * @var MediaResource
             */
            'image' => $this->when(
                filled($this->resource->image),
                fn() => MediaResource::make($this->resource->image),
            ),

            /**
             * Изображение для мобильного
             *
             * @var MediaResource
             */
            'image_mobile' => $this->when(
                filled($this->resource->imageMobile),
                fn() => MediaResource::make($this->resource->imageMobile),
            ),

            /**
             * Видеообложка
             *
             * @var MediaResource
             */
            'video_cover' => $this->when(
                filled($this->resource->videoCover),
                fn() => MediaResource::make($this->resource->videoCover),
            ),

            /**
             * Ссылка ЧПУ
             *
             * @var string
             *
             * @example https://example.com
             */
            'link' => $this->resource->link,

            /**
             * Флаг "Большая карточка"
             *
             * @var int
             *
             * @example 1
             */
            'is_big' => $this->resource->is_big,

            /**
             * Имеет описанный кейс
             *
             * @var bool
             *
             * @example true
             */
            'is_case' => $this->resource->is_case,

            /**
             * Кейс проекта
             *
             * @var array
             *
             * @example []
             */
            'content' => $this->resource->formatted_content,
        ];
    }
}

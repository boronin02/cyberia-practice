<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Author\AuthorResource;
use App\Http\Resources\Tags\TagResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Post $resource
 */
final class PostPreviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $resource = $this->resource;

        return [
            /**
             * ID поста.
             *
             * @var int
             *
             * @example 1
             */
            'id' => $resource->id,

            /**
             * Заголовок поста.
             *
             * @var string
             *
             * @example Чистый код: 10 советов хорошего нейминга
             */
            'title' => $resource->title,

            /**
             * Описание поста.
             *
             * @var string|null
             *
             * @example Мы вошли в число лучших IT-студий России...
             */
            'description' => $resource->description,

            /**
             * Slug поста.
             *
             * @var string
             *
             * @example example-post
             */
            'slug' => $resource->slug,

            /**
             * URL превью изображения поста.
             *
             * @var string
             *
             * @example https://example.com
             */
            'image_preview' => $resource->image_preview_url,

            /**
             * Флаг "Популярное".
             *
             * @var int
             *
             * @example 1
             */
            'is_popular' => $resource->is_popular,

            /**
             * Флаг "Новость".
             *
             * @var int
             *
             * @example 1
             */
            'is_news' => $resource->is_news,

            /**
             * Опубликовано.
             *
             * @var int
             *
             * @example 13425332
             */
            'published_at' => $resource->published_at?->timestamp,

            /**
             * Авторы поста.
             */
            'authors' => AuthorResource::collection($this->whenLoaded('authors')),

            /**
             * Теги поста.
             */
            'tags' => TagResource::collection($this->whenLoaded('tagsOrdered')),
        ];
    }
}

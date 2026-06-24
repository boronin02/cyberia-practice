<?php

namespace App\Http\Requests\API\Posts;

use App\Support\Pagination\Paginateable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Pkg\WebApp\v1\Traits\RequestHasFilters;
use Pkg\WebApp\v1\Traits\RequestHasSorters;

final class IndexPostRequest extends FormRequest
{
    use Paginateable, RequestHasFilters, RequestHasSorters;

    public function rules(): iterable
    {
        return $this->withPaginationRules([
            /**
             * Фильтр "Популярное"
             *
             * @example 1
             */
            'is_popular' => ['sometimes', 'boolean'],

            /**
             * Фильтр "Новость"
             *
             * @example 1
             */
            'is_news' => ['sometimes', 'boolean'],

            /**
             * Фильтр по автору
             *
             * @example 1
             */
            'author_id' => ['sometimes', 'integer', 'exists:authors,id'],

            /**
             * Фильтр по тегам
             *
             * @example 1,4,15
             */
            'tag_ids' => ['sometimes', 'exists:tags,id'],
        ]);
    }

    public function filters(): iterable
    {
        return [
            'is_popular' => function (Builder $builder, string $value) {
                return $builder->where('is_popular', $value);
            },
            'is_news' => function (Builder $builder, string $value) {
                return $builder->where('is_news', $value);
            },
            'author_id' => function (Builder $builder, string $value) {
                return $builder->whereHas('authors', function (Builder $query) use ($value) {
                    $query->where('author_id', $value);
                });
            },
            'tag_ids' => function (Builder $builder, string $value) {
                return $builder->whereHas('tags', function (Builder $query) use ($value) {
                    return $query->whereIntegerInRaw('tag_id', explode(',', $value));
                });
            },
        ];
    }

    public function sorters(): iterable
    {
        return [
            'published_at' => function ($builder, $direction) {
                return $builder->orderBy('published_at', $direction);
            },
        ];
    }

    public function defaultSorter(Builder $builder): Builder
    {
        return $builder->orderBy('published_at', 'desc');
    }
}

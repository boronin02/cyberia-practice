<?php

namespace Pkg\WebApp\v1\Helpers;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @deprecated Use `App\Support\Pagination\PaginationResource`.
 */
class Paginated
{
    public static function paginate($page, $perPage, EloquentBuilder|QueryBuilder $builder, string $resourceClass, $request = null): array
    {
        if (empty($request)) {
            $request = request();
        }

        $result = $builder->paginate($perPage, ['*'], null, $page);

        return [
            'pagination' => [
                'page' => (int) $page,
                'per_page' => $result->perPage(),
                'total' => $result->total(),
                'last_page' => $result->lastPage(),
            ],
            'items' => $resourceClass::collection($result->items())->toArray($request),
        ];
    }
}

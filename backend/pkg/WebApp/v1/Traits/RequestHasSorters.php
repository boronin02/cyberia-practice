<?php

namespace Pkg\WebApp\v1\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

trait RequestHasSorters
{
    public function sort(Builder|QueryBuilder $builder): Builder|QueryBuilder
    {
        $sorters = $this->sorters();
        $direction = $this->query('sortDirection', 'asc');

        return match (true) {
            $this->has('sort') => $this->applySortFromRequest($builder, $sorters, $direction),
            method_exists($this, 'defaultSorter') => $this->defaultSorter($builder),
            default => $builder,
        };
    }

    private function applySortFromRequest(
        Builder|QueryBuilder $builder,
        array                $sorters,
        string               $direction
    ): Builder|QueryBuilder {
        $field = $this->query('sort');

        if (array_key_exists($field, $sorters) && is_callable($sorters[$field])) {
            return $sorters[$field]($builder, $direction);
        }

        return $builder;
    }
}

<?php

namespace Pkg\WebApp\v1\Traits;

use Illuminate\Database\Eloquent\Builder;

trait RequestHasFilters
{
    public function filter(Builder|\Illuminate\Database\Query\Builder $builder): Builder|\Illuminate\Database\Query\Builder
    {
        $filters = $this->filters();

        foreach ($filters as $key => $filterCallable) {
            if ($this->has($key)) {
                $builder = $filterCallable($builder, $this->query($key));
            }
        }

        return $builder;
    }
}

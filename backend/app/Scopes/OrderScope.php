<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

final class OrderScope implements Scope
{
    protected string $orderColumn;

    protected string $orderDirection;

    public function __construct(string $orderColumn = 'order', string $orderDirection = 'asc')
    {
        $this->orderColumn = $orderColumn;
        $this->orderDirection = $orderDirection;
    }

    public function apply(Builder $builder, Model $model): void
    {
        $builder->orderBy($this->orderColumn, $this->orderDirection);
    }
}

<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasAutomaticOrder
{
    public string $orderAttribute = 'order';

    public function creating(Model $model): void
    {
        $model->{$this->orderAttribute} = $model::max($this->orderAttribute) + 1;
    }
}

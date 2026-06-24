<?php

namespace App\Traits;

use App\Scopes\OrderScope;

trait Orderable
{
    protected static function booted(): void
    {
        static::addGlobalScope(new OrderScope);
    }
}

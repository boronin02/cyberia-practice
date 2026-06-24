<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;

final class ClearResponseCacheRequested
{
    public function __construct(
        public readonly Model $model,
    ) {
    }
}

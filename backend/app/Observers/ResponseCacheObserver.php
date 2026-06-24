<?php

namespace App\Observers;

use App\Events\ClearResponseCacheRequested;
use Illuminate\Database\Eloquent\Model;

final class ResponseCacheObserver
{
    public function created(Model $model): void
    {
        event(new ClearResponseCacheRequested($model));
    }

    public function updated(Model $model): void
    {
        event(new ClearResponseCacheRequested($model));
    }

    public function deleted(Model $model): void
    {
        event(new ClearResponseCacheRequested($model));
    }
}

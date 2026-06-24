<?php

namespace App\Models\Concerns;

use App\Observers\ResponseCacheObserver;

trait ClearsResponseCache
{
    public static function bootClearsResponseCache(): void
    {
        static::observe(ResponseCacheObserver::class);
    }
}

<?php

namespace App\Listeners;

use App\Events\ClearResponseCacheRequested;
use Spatie\MediaLibrary\MediaCollections\Events\CollectionHasBeenClearedEvent;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;
use Spatie\ResponseCache\Facades\ResponseCache;

final class ClearResponseCache
{
    public function handle(MediaHasBeenAddedEvent|CollectionHasBeenClearedEvent|ClearResponseCacheRequested $event): void
    {
        ResponseCache::clear();
    }
}

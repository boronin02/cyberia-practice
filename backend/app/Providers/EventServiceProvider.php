<?php

namespace App\Providers;

use App\Events\ClearResponseCacheRequested;
use App\Events\FeedbackCreated;
use App\Listeners\ClearResponseCache;
use App\Listeners\SendFeedbackNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spatie\MediaLibrary\MediaCollections\Events\CollectionHasBeenClearedEvent;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;

final class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        FeedbackCreated::class => [
            SendFeedbackNotification::class,
        ],

        ClearResponseCacheRequested::class => [
            ClearResponseCache::class,
        ],

        MediaHasBeenAddedEvent::class => [
            ClearResponseCache::class,
        ],

        CollectionHasBeenClearedEvent::class => [
            ClearResponseCache::class,
        ],
    ];

    public function boot(): void
    {
    }
}

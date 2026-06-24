<?php

namespace App\Providers;

use App\Observers\ResponseCacheObserver;
use Illuminate\Support\ServiceProvider;
use Pkg\WebApp\v1\Helpers\Boilerplate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Boilerplate::enforceAppSchema();
        Boilerplate::enforceForwardedProto();

        Media::observe(ResponseCacheObserver::class);
    }
}

<?php

use App\Http\Controllers\API\ProjectController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::prefix('projects')
    ->name('projects.')
    ->middleware([
        CacheResponse::class,
    ])
    ->group(function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::get('/list-for-sitemap', [ProjectController::class, 'listForSitemap']);
        Route::get('/{slug}', [ProjectController::class, 'show'])
            ->where('slug', '[a-z0-9-]+');
        Route::get('/{slug}/related', [ProjectController::class, 'related'])
            ->where('slug', '[a-z0-9-]+');
    });

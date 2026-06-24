<?php

use App\Http\Controllers\API\BannerController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::prefix('banners')
    ->middleware([
        CacheResponse::class,
    ])
    ->group(function () {
        Route::get('', [BannerController::class, 'index']);
    });

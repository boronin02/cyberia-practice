<?php

use App\Http\Controllers\API\ReviewController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::prefix('reviews')
    ->name('reviews.')
    ->middleware([
        CacheResponse::class,
    ])
    ->group(function () {
        Route::get('/', [ReviewController::class, 'index'])
            ->name('index');
    });

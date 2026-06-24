<?php

use App\Http\Controllers\API\TagController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::prefix('tags')
    ->middleware([
        CacheResponse::class,
    ])
    ->group(function () {
        Route::get('', [TagController::class, 'index']);
    });

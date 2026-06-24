<?php

use App\Http\Controllers\API\AwardController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::prefix('awards')
    ->middleware([
        CacheResponse::class,
    ])
    ->group(function () {
        Route::get('', [AwardController::class, 'index']);
    });

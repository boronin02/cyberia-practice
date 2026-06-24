<?php

use App\Http\Controllers\API\AuthorController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::prefix('authors')
    ->name('authors.')
    ->middleware([
        CacheResponse::class,
    ])
    ->group(function () {
        Route::get('/{author}', [AuthorController::class, 'show'])
            ->name('show');
    });

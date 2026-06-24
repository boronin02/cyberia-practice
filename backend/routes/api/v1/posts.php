<?php

use App\Http\Controllers\API\PostController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::prefix('posts')
    ->name('posts.')
    ->middleware([
        CacheResponse::class,
    ])
    ->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::get('/list-for-sitemap', [PostController::class, 'listForSitemap']);
        Route::get('/{post}', [PostController::class, 'show']);
    });

<?php

use App\Http\Controllers\API\DictionaryController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::prefix('dictionaries')
    ->name('dictionaries.')
    ->middleware([
        CacheResponse::class,
    ])
    ->group(function () {
        Route::get('', [DictionaryController::class, 'index'])
            ->name('index');
    });

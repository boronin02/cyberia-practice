<?php

use App\Http\Controllers\API\ProjectCategoryController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::prefix('project-categories')
    ->middleware([
        CacheResponse::class,
    ])
    ->group(function () {
        Route::get('', [ProjectCategoryController::class, 'index']);
    });

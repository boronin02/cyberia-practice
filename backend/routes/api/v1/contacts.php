<?php

use App\Http\Controllers\API\ContactsController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::prefix('contacts')
    ->name('contacts.')
    ->middleware([
        CacheResponse::class,
    ])
    ->group(function () {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/store', [ContactsController::class, 'store'])
                ->name('store');
            Route::put('/{id}/update', [ContactsController::class, 'update'])
                ->name('update');
            Route::delete('/{id}/destroy', [ContactsController::class, 'destroy'])
                ->name('destroy');
        });
        Route::get('/', [ContactsController::class, 'index'])
            ->name('index');
        Route::get('/{id}', [ContactsController::class, 'show'])
            ->name('show');
    });

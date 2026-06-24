<?php

use App\Http\Controllers\API\VacancyController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::prefix('vacancies')
    ->name('vacancies.')
    ->middleware([
        CacheResponse::class,
    ])
    ->group(function () {
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/', [VacancyController::class, 'store'])
                ->name('store');
            Route::put('/{id}', [VacancyController::class, 'update'])
                ->name('update');
            Route::delete('/{id}', [VacancyController::class, 'destroy'])
                ->name('destroy');
        });
        Route::get('/', [VacancyController::class, 'index'])
            ->name('index');
        Route::get('/{id}', [VacancyController::class, 'show'])
            ->name('show');
    });

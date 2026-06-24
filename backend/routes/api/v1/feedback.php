<?php

use App\Http\Controllers\API\FeedbackController;
use Illuminate\Support\Facades\Route;

Route::prefix('feedback')
    ->name('feedback.')
    ->group(function () {
        Route::post('/', [FeedbackController::class, 'store'])
            ->name('store');
    });

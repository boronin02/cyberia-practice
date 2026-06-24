<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('api.')
    ->group(function () {
        require __DIR__ . '/api/v1/projects.php';
        require __DIR__ . '/api/v1/reviews.php';
        require __DIR__ . '/api/v1/contacts.php';
        require __DIR__ . '/api/v1/feedback.php';
        require __DIR__ . '/api/v1/vacancies.php';
        require __DIR__ . '/api/v1/posts.php';
        require __DIR__ . '/api/v1/authors.php';
        require __DIR__ . '/api/v1/dictionaries.php';
        require __DIR__ . '/api/v1/project-categories.php';
        require __DIR__ . '/api/v1/banners.php';
        require __DIR__ . '/api/v1/awards.php';
        require __DIR__ . '/api/v1/tags.php';
    });

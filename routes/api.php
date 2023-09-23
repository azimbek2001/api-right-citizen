<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', \App\Http\Controllers\Api\V1\Auth\LoginController::class)->name('login');
    Route::post('/register', \App\Http\Controllers\Api\V1\Auth\RegisterController::class)->name('user.register');
});

Route::get('/categories', [\App\Http\Controllers\Api\V1\Category\CategoryController::class, 'index'])->name('categories');

Route::get('/publishes', [\App\Http\Controllers\Api\V1\Publish\PublishController::class, 'index'])->name('publishes');

Route::group(['as' => 'api.', 'middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/me', [\App\Http\Controllers\Api\V1\User\UserController::class, 'getMe'])->name('me');
    });
});

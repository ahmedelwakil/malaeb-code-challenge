<?php

use App\Http\Controllers\AuthController;
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

/** Authenticated Routes */
Route::middleware('auth:api')->group(function () {
    Route::name('auth.')->prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

/** Public Routes */
Route::name('auth.')->prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

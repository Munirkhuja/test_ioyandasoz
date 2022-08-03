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

Route::post('login', [\App\Http\Controllers\Api\v1\Auth\LoginController::class,'login']);


Route::group([
    'middleware' => ['auth:api'],
], function () {
    Route::post('logout', [\App\Http\Controllers\Api\v1\Auth\LogoutController::class,'logout']);
    Route::post('refresh_token', [\App\Http\Controllers\Api\v1\Auth\LoginController::class,'refreshToken']);

    Route::post('driver/store', [\App\Http\Controllers\Api\v1\DriverController::class,'store']);

    Route::get('order/assigned_driver', [\App\Http\Controllers\Api\v1\OrderController::class,'all_driver_assigned']);
    Route::get('order/assigned_driver/{id}', [\App\Http\Controllers\Api\v1\OrderController::class,'driver_assigned']);

    Route::get('order/completed/{id}', [\App\Http\Controllers\Api\v1\OrderController::class,'completed']);

});

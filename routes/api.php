<?php

use App\Http\Controllers\WeddingController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => 'api'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::group(['middleware' => 'jwt.verify'], function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh']);
        });
    });
    Route::group(['prefix' => 'user', 'middleware' => 'jwt.verify'], function () {
        Route::get('', [UserController::class, 'show']);
        Route::put('update', [UserController::class, 'update']);
    });
    Route::group(['prefix' => 'wedding'],function ()
    {
        Route::get('/getWedding', [WeddingController::class, 'index']);
        Route::post('/savePlanner',[WeddingController::class, 'store']);
        Route::post('/updatePlan/{id}',[WeddingController::class, 'update']);
        Route::post('/deletePlan/{id}',[WeddingController::class, 'destroy']);
    });
});
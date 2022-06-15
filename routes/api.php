<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LunchDateController;
use App\Http\Controllers\RecordController;
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

Route::domain(env('API_URL'))->group(function () {
    Route::post('/getdata', [AuthController::class, 'get_data'])->name('getdata');
    Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
    Route::group(['middleware' => 'isActive'], function () {
        Route::post('/off-day', [LunchDateController::class, 'showWeekend'])->name('userOffday');
    });
});

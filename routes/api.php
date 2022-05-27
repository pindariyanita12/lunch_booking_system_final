<?php

use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\LunchDateController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user;
});
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/getdata', [AuthController::class, 'get_data'])->name('getdata');
Route::group(['middleware' =>'isActive'], function () {

    Route::post('/off-day',[LunchDateController::class,'showWeekend'])->name('userOffday');
    Route::post('/lunch-taken',[RecordController::class,'lunchTaken'])->name('lunchTaken');
    Route::post('/signout', [AuthController::class, 'signout'])->name('signout');

});



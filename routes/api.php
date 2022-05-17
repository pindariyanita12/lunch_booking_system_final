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
Route::post('/signin', [AuthController::class, 'signin']);
// Route::post('/addlunch', [RecordController::class, 'addLunch'])->middleware('auth:sanctum');

Route::get('/callback', [AuthController::class, 'callback']);

Route::post('/signout', [AuthController::class, 'signout']);
Route::post('/getdata', [AuthController::class, 'get_data']);
Route::post('/logout',[UserController::class,'logout']);
 Route::group(['middleware' =>'isActive'], function () {

    Route::post('/add-request',[RecordController::class,'addRequest']);
    Route::post('/add-guests',[RecordController::class,'addGuests']);
    Route::post('/delete-request',[RecordController::class,'deleteRequest']);
    Route::post('/off-day',[LunchDateController::class,'showWeekend']);
    Route::post('/lunch-taken',[RecordController::class,'lunchTaken']);
    Route::post('/check',[AdminController::class,'check']);

});



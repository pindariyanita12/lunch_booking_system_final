<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\LunchDateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });
Route::post('/addlunch', [RecordController::class, 'addLunch']);

// Route::get('/', [HomeController::class, 'welcome']);
// Route::get('signin', [AuthController::class, 'signin']);
// Route::get('/callback', [AuthController::class, 'callback']);
// Route::get('/signout', [AuthController::class, 'signout']);

Route::get('/weekend',function(){
    return view('admin.weekend');
});
Route::get('/admindashboard',[AdminController::class,'show'])->middleware('auth','can:isAdmin');
Route::get('/offday',[AdminController::class,'offday']);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/date-wise',[AdminController::class,'dateWise']);
Route::post('/month-wise',[AdminController::class,'monthWise']);
Route::get('/users/{name}',[AdminController::class,'monthWise']);
Route::post('/add-weekend',[LunchDateController::class,'addWeekend'])->middleware('auth','can:isAdmin');
Route::get('datatable', [DataTableController::class,'index']);
Route::get('get', [DataTableController::class,'get']);

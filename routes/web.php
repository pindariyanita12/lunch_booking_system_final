<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LunchDateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//user route
Route::domain('https://lunch-app.dev.local')->group(function () {
    Route::get('/', function () {
        return view('user.login');
    });
    Route::get('/handler', function () {
        return view('user.handler');
    });
    Route::get('/user/welcome', function () {
        return view('user.welcome');
    });
    Route::get('/user/offday', function () {
        return view('user.offday');
    });
    Route::get('/handler', function () {
        return view('user.handler');
    });

});

//admin route
Route::domain('https://lunch-admin.dev.local')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('/lang/{locale}',[AdminController::class,'lang']);
    Route::get('/admindashboard', [AdminController::class, 'show'])->name('admin.admindashboard.show')->middleware('auth', 'can:isAdmin');
    Route::get('/offday', [AdminController::class, 'offday']);
    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/date-wise', [AdminController::class, 'dateWise'])->name('admin.dateWiserecord.dateWise');
    Route::get('/month-wise', [AdminController::class, 'monthWise'])->name('admin.monthWiserecord.monthWise');
    Route::post('/add-weekend', [LunchDateController::class, 'addWeekend'])->middleware('auth', 'can:isAdmin');
    Route::get('/destroy/{id}/{idis}', [AdminController::class, 'destroy'])->name('admin.admindashboard.destroy');
    Route::get('/destroymonthwise/{id}/{idis}', [AdminController::class, 'destroymonthwise'])->name('admin.admindashboard.destroymonthwise');
    Route::post('/edit', [AdminController::class, 'useredit'])->name('admin.admindashboard.edit');
    Route::get('/daily-dishes', [AdminController::class, 'dailyDishes'])->name('admin.dailydishes.dailyDishes');
    Route::get('/daily-dishes/trainees', [AdminController::class, 'trainees'])->name('admin.dailydishes.trainees');
    Route::get('/daily-dishes/employees', [AdminController::class, 'employees'])->name('admin.dailydishes.employees');
});

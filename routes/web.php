<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LunchDateController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Env;
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
Route::domain(env('APP_URL'))->group(function () {
    Route::get('/', function () {
        return view('user.login');
    });
    Route::get('/handler', 'AuthController@handler');

    Route::group(['middleware' => 'auth'], function(){
        Route::get('/user/welcome', 'UserController@home')->name('user.welcome');
        Route::get('/user/offday', 'LunchDateController@showWeekend');
        Route::get('/lunch-taken', [RecordController::class, 'lunchTaken'])->name('lunchTaken');
        Route::get('/signout', [AuthController::class, 'signout'])->name('signout');
    });

});

//admin route
Route::domain(env('ADMIN_URL'))->group(function () {

    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('/register', function () {
        return redirect('login');
    });
    Route::get('/totalemployee', function () {
        return view('admin.employee');
    });
    Route::get('/empdelete', [AdminController::class, 'empDelete'])->name('admin.admindashboard.empdelete');
    Route::post('/addemployee',[AdminController::class,'addEmployee'])->name('admin.admindashboard.empadd');
    Route::post('/addguests',[AdminController::class,'addGuests'])->name('admin.admindashboard.addguests');
    Route::get('user/listing',[AdminController::class,'getEmployee'])->name('user.list');
    Route::get('/lang/{locale}', [AdminController::class, 'lang']);
    Route::get('/admindashboard', [AdminController::class, 'show'])->name('admin.admindashboard.show')->middleware('auth', 'can:isAdmin');
    Route::get('/offday', [AdminController::class, 'offday']);
    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/add-weekend', [LunchDateController::class, 'addWeekend'])->middleware('auth', 'can:isAdmin');
    Route::get('/destroy', [AdminController::class, 'destroy'])->name('admin.admindashboard.destroy');
    Route::get('/destroymonthwise', [AdminController::class, 'destroyMonthwise'])->name('admin.admindashboard.destroymonthwise');
    Route::post('/edit', [AdminController::class, 'employeeEdit'])->name('admin.admindashboard.edit');
    Route::get('/daily-dishes', [AdminController::class, 'dailyDishes'])->name('admin.dailydishes.dailyDishes');
    Route::get('/daily-dishes/trainees', [AdminController::class, 'trainees'])->name('admin.dailydishes.trainees');
    Route::get('/daily-dishes/employees', [AdminController::class, 'employees'])->name('admin.dailydishes.employees');
    Route::post('/addmanualrecord', [AdminController::class, 'addManualRecord'])->name('admin.dailydishes.addmanualrecord');
    Route::post('autocomplete', [AdminController::class, 'autoComplete'])->name('autocomplete');
});

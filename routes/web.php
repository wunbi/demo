<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserGroupController;

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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('home', [HomeController::class, 'index'])->name('home'); //Admin帳號登入

Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'task'], function () {
        Route::get(null, [TaskController::class, 'index'])->name('task.index');
        Route::get('/create/{action}', [TaskController::class, 'create'])->name('task.create');
        Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
        Route::post('/update', [TaskController::class, 'update'])->name('task.update');
    });


    Route::group(['prefix' => 'user'], function () {
        Route::get(null, [UserController::class, 'index'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update', [UserController::class, 'update'])->name('user.update');
    });

    Route::group(['prefix' => 'userGroup'], function () {
        Route::get(null, [UserGroupController::class, 'index'])->name('userGroup.index');
        Route::get('/create', [UserGroupController::class, 'create'])->name('userGroup.create');
        Route::get('/edit/{id}', [UserGroupController::class, 'edit'])->name('userGroup.edit');
        Route::post('/update', [UserGroupController::class, 'update'])->name('userGroup.update');
    });
});


Auth::routes();

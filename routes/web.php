<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;

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
    Route::get('task', [TaskController::class, 'index'])->name('task.index'); //Admin帳號登入
});


Auth::routes();

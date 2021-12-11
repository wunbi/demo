<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TestController;

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
    //return view('welcome');

    return view('login');
});

Route::post('dologin', [LoginController::class, 'doLogin'])->name('doLogin'); //Admin帳號登入

Route::group(['middleware' => ['auth']], function () {
    Route::get('index', [TestController::class, 'index'])->name('index'); //Admin帳號登入
});

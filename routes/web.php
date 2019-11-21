<?php

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

use App\Http\Controllers\HomeController;

Route::get('/', function() {
    return view('welcome');
});

//Route::get('/home', HomeController::class . '@index');
Auth::routes(['verify' => true]);
Route::get('/admin/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('admin.login.index');
Route::post('/admin/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('admin.login');
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
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersTypeController;

Route::get('/', function() {
    return view('master');
});

Route::get('/home', HomeController::class . '@index');

Route::resource('users', UsersController::class);

Route::get('users-types', [UsersTypeController::class, 'index']);

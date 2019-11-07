<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersTypeController;

Route::get('/', function() {
    return view('admin.master');
})->name('dashboard');

Route::resource('users', UsersController::class);
Route::get('users-types', [UsersTypeController::class, 'index'])->name('user-types');

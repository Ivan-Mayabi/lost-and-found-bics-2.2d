<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.users.index');
})->name('/');

// Setting up the routes that admins will use
Route::resource('users',UserController::class);
Route::resource('roles',RoleController::class);

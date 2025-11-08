<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.admin');
});

// Setting up the routes that admins will use
Route::resource('users',UserController::class);
Route::resource('roles',RoleController::class);

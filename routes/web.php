<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[UserController::class,'index'])->name('/');

// Setting up the routes that admins will use
Route::resource('users',UserController::class);
Route::resource('roles',RoleController::class);

// Route for reseting password
Route::post('users/{user}/reset-password',[UserController::class,'reset_password'])->name('users.reset-password');
Route::post('users/{user}/deactivate',[UserController::class,'deactivate'])->name('users.deactivate');

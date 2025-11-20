<?php

use App\Http\Controllers\IdReplacementController;
use App\Http\Controllers\ItemClaimedController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemLostController;
use App\Http\Controllers\PaymentController;
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

// Lost & Found Manager routes
Route::resource('items', ItemController::class);
Route::resource('items-lost', ItemLostController::class);
Route::resource('items-claimed', ItemClaimedController::class);
Route::post('items-lost/{itemLost}/mark-as-taken', [ItemLostController::class, 'markAsTaken'])->name('items-lost.mark-as-taken');
Route::post('items-claimed/{itemClaimed}/verify', [ItemClaimedController::class, 'verify'])->name('items-claimed.verify');

// ID Replacement routes
Route::resource('payments', PaymentController::class);
Route::resource('id-replacements', IdReplacementController::class);
Route::post('payments/{payment}/verify', [PaymentController::class, 'verify'])->name('payments.verify')->middleware('id.approver');
Route::post('id-replacements/{idReplacement}/approve', [IdReplacementController::class, 'approve'])->name('id-replacements.approve')->middleware('id.approver');
Route::post('id-replacements/{idReplacement}/reject', [IdReplacementController::class, 'reject'])->name('id-replacements.reject')->middleware('id.approver');

<?php

use App\Http\Controllers\LostAndFoundManagerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClaimController;

Route::get('/', [UserController::class, 'index'])->name('/');

// Login routes
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('authenticate', [UserController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [UserController::class, 'logout'])->name('logout');


/* ============ Protected Routes ============ */
Route::middleware('auth')->group(function () {

    // Admin Routes
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    Route::post('users/{user}/reset-password', [UserController::class, 'reset_password'])->name('users.reset-password');
    Route::post('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');


    /* Lost and Found Manager Routes */
    Route::prefix('lost-and-found-manager')->group(function () {

        Route::get('/', [LostAndFoundManagerController::class, 'index'])->name('lfm.dashboard');

        Route::get('/items/create', [LostAndFoundManagerController::class, 'createItem'])->name('lfm.items.create');
        Route::post('/items/store', [LostAndFoundManagerController::class, 'storeItem'])->name('lfm.items.store');

        Route::get('lost-items/create', [LostAndFoundManagerController::class, 'createLost'])->name('lfm.lost.create');
        Route::post('lost-items/store', [LostAndFoundManagerController::class, 'storeLost'])->name('lfm.lost.store');

        Route::get('/claims', [LostAndFoundManagerController::class, 'verifyClaims'])->name('lfm.claims.index');
        Route::post('/claims/{id}/approve', [LostAndFoundManagerController::class, 'approveClaim'])->name('lfm.claims.approve');
        Route::delete('/claims/{id}/reject', [LostAndFoundManagerController::class, 'rejectClaim'])->name('lfm.claims.reject');

        // Item Management
        Route::get('/items/{id}/edit', [LostAndFoundManagerController::class, 'editItem'])->name('lfm.items.edit');
        Route::put('/items/{id}', [LostAndFoundManagerController::class, 'updateItem'])->name('lfm.items.update');
        Route::delete('/items/{id}', [LostAndFoundManagerController::class, 'deleteItem'])->name('lfm.items.delete');

        // Lost Item Management
        Route::get('/lost-items/{id}/edit', [LostAndFoundManagerController::class, 'editLostItem'])->name('lfm.lostitems.edit');
        Route::put('/lost-items/{id}', [LostAndFoundManagerController::class, 'updateLostItem'])->name('lfm.lostitems.update');
        Route::delete('/lost-items/{id}', [LostAndFoundManagerController::class, 'deleteLostItem'])->name('lfm.lostitems.delete');

    });


    /* ============ Regular User Claim Routes ============ */
    Route::prefix('regular')->name('regular.')->group(function () {

        Route::get('/claims', [ClaimController::class, 'index'])->name('claims.index');
        Route::get('/claims/create/{lostItemId}', [ClaimController::class, 'create'])->name('claims.create');
        Route::post('/claims', [ClaimController::class, 'store'])->name('claims.store');
        Route::get('/claims/history', [ClaimController::class, 'history'])->name('claims.history');

    });

}); // END auth group

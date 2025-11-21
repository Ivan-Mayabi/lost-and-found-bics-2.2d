<?php

use App\Http\Controllers\LostAndFoundManagerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemLostController;
use Illuminate\Support\Facades\Route;

// --------------------
// Home / Dashboard
// --------------------
Route::get('/', [UserController::class, 'index'])->name('/');

// --------------------
// Admin Routes
// --------------------
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);

// Admin actions
Route::post('users/{user}/reset-password', [UserController::class, 'reset_password'])->name('users.reset-password');
Route::post('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');

// --------------------
// Lost & Found Manager Routes
// Prefix: /lost-and-found-manager
// --------------------
Route::prefix('lost-and-found-manager')->group(function () {
    Route::get('/', [LostAndFoundManagerController::class, 'index'])->name('lfm.dashboard');

    // Found Items
    Route::get('/items/create', [LostAndFoundManagerController::class, 'createItem'])->name('lfm.items.create');
    Route::post('/items/store', [LostAndFoundManagerController::class, 'storeItem'])->name('lfm.items.store');
    Route::get('/items/{id}/edit', [LostAndFoundManagerController::class, 'editItem'])->name('lfm.items.edit');
    Route::put('/items/{id}', [LostAndFoundManagerController::class, 'updateItem'])->name('lfm.items.update');
    Route::delete('/items/{id}', [LostAndFoundManagerController::class, 'deleteItem'])->name('lfm.items.delete');

    // Lost Items
    Route::get('/lost-items/create', [LostAndFoundManagerController::class, 'createLost'])->name('lfm.lost.create');
    Route::post('/lost-items/store', [LostAndFoundManagerController::class, 'storeLost'])->name('lfm.lost.store');
    Route::get('/lost-items/{id}/edit', [LostAndFoundManagerController::class, 'editLostItem'])->name('lfm.lostitems.edit');
    Route::put('/lost-items/{id}', [LostAndFoundManagerController::class, 'updateLostItem'])->name('lfm.lostitems.update');
    Route::delete('/lost-items/{id}', [LostAndFoundManagerController::class, 'deleteLostItem'])->name('lfm.lostitems.delete');

    // Claims
    Route::get('/claims', [LostAndFoundManagerController::class, 'verifyClaims'])->name('lfm.claims.index');
    Route::post('/claims/{id}/approve', [LostAndFoundManagerController::class, 'approveClaim'])->name('lfm.claims.approve');
    Route::delete('/claims/{id}/reject', [LostAndFoundManagerController::class, 'rejectClaim'])->name('lfm.claims.reject');
});

// --------------------
// Student / Regular User Routes
// Prefix: /user
// --------------------
Route::prefix('user')->group(function () {

    // Lost Items
    Route::get('/lost-items', [ItemLostController::class, 'index'])->name('user.lost-items.index');
    Route::get('/lost-items/create', [ItemLostController::class, 'create'])->name('user.lost-items.create');
    Route::post('/lost-items', [ItemLostController::class, 'store'])->name('user.lost-items.store');
    Route::get('/lost-items/{itemLost}', [ItemLostController::class, 'show'])->name('user.lost-items.show');

    // Claims — temporary placeholder
    Route::get('/claims', function () {
        return 'Claims page coming soon.';
    })->name('user.claims.index');

    Route::post('/claims', function () {
        return 'Claim submission coming soon.';
    })->name('user.claims.store');

    // --------------------
    // Temporary IDs
    // URL: /user/temporary-ids/*
    // --------------------
    Route::prefix('temporary-ids')->group(function () {

        Route::get('/', [\App\Http\Controllers\IdReplacementController::class, 'index'])
            ->name('user.temporary-ids.index');

        Route::get('/create', [\App\Http\Controllers\IdReplacementController::class, 'create'])
            ->name('user.temporary-ids.create');

        Route::post('/', [\App\Http\Controllers\IdReplacementController::class, 'store'])
            ->name('user.temporary-ids.store');

        Route::get('/{idReplacement}', [\App\Http\Controllers\IdReplacementController::class, 'show'])
            ->name('user.temporary-ids.show');
    });

});

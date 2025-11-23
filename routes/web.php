<?php

use App\Http\Controllers\LostAndFoundManagerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemLostController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// --------------------
// Public / Home Routes
// --------------------
Route::get('/',function(){
    return view('auth.login');
})->name('/');

// Login / Logout
Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('authenticate', [UserController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [UserController::class, 'logout'])->name('logout');

// --------------------
// Protected Routes
// --------------------
Route::middleware('auth')->group(function () {

    // --------------------
    // Admin Routes
    // --------------------
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    // --------------------
    // Payment Routes
    // --------------------
    Route::resource('payments',PaymentController::class);
    Route::post('payments/{payment}/approve',[PaymentController::class,'approve'])->name('payments.approve');
    Route::post('payments/{payment}/reject',[PaymentController::class,'reject'])->name('payments.reject');

    Route::post('users/{user}/reset-password', [UserController::class, 'reset_password'])->name('users.reset-password');
    Route::post('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
    

    // --------------------
    // Lost & Found Manager Routes
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

        // Claims for Lost & Found Manager
        Route::get('/claims', [LostAndFoundManagerController::class, 'verifyClaims'])->name('lfm.claims.index');
        Route::post('/claims/{id}/approve', [LostAndFoundManagerController::class, 'approveClaim'])->name('lfm.claims.approve');
        Route::delete('/claims/{id}/reject', [LostAndFoundManagerController::class, 'rejectClaim'])->name('lfm.claims.reject');
    });

    // --------------------
    // Student / Regular User Routes
    // --------------------
    Route::prefix('user')->group(function () {

        // Lost Items
        Route::get('/lost-items', [ItemLostController::class, 'index'])->name('user.lost-items.index');
        Route::get('/lost-items/create', [ItemLostController::class, 'create'])->name('user.lost-items.create');
        Route::post('/lost-items', [ItemLostController::class, 'store'])->name('user.lost-items.store');
        Route::get('/lost-items/{itemLost}', [ItemLostController::class, 'show'])->name('user.lost-items.show');

        // Claims (real implementation from ClaimController)
        Route::get('/claims', [ClaimController::class, 'index'])->name('user.claims.index');
        Route::get('/claims/create/{lostItemId}', [ClaimController::class, 'create'])->name('user.claims.create');
        Route::post('/claims', [ClaimController::class, 'store'])->name('user.claims.store');
        Route::get('/claims/history', [ClaimController::class, 'history'])->name('user.claims.history');

        // Temporary IDs
        Route::prefix('temporary-ids')->group(function () {
            Route::get('/', [\App\Http\Controllers\IdReplacementController::class, 'indexView'])->name('user.temporary-ids.index');
            Route::get('/create', [\App\Http\Controllers\IdReplacementController::class, 'create'])->name('user.temporary-ids.create');
            Route::post('/', [\App\Http\Controllers\IdReplacementController::class, 'store'])->name('user.temporary-ids.store');
            Route::get('/{idReplacement}', [\App\Http\Controllers\IdReplacementController::class, 'show'])->name('user.temporary-ids.show');
        });
    });

    // -------------------------------
    // ID Approver routes
    // -------------------------------
    Route::get('/id-approver',[UserController::class,'request_id_replacement'])->name('users.request-id-replacement');
    Route::post('/id-approver/{replacement_id}/approve',[UserController::class,'approve_id_replacement'])->name('id-replacements.approve');
    Route::post('/id-approver/{replacement_id}/reject',[UserController::class,'reject_id_replacement'])->name('id-replacements.reject');

});

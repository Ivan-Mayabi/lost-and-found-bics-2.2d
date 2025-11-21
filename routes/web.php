<?php
use App\Http\Controllers\LostAndFoundManagerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[UserController::class,'index'])->name('/');

// Setting up the routes to login
Route::get('login',[UserController::class,'login'])->name('login');
Route::post('authenticate',[UserController::class,'authenticate'])->name('authenticate');
Route::post('logout',[UserController::class,'logout'])->name('logout');

/* ========================================Closed routes=============================================== */
Route::middleware('auth')->group(function(){
    // All closed routes go here
    // Setting up the routes that admins will use
    Route::resource('users',UserController::class);
    Route::resource('roles',RoleController::class);

    // Route for reseting password
    Route::post('users/{user}/reset-password',[UserController::class,'reset_password'])->name('users.reset-password');
    Route::post('users/{user}/deactivate',[UserController::class,'deactivate'])->name('users.deactivate');

    // routes for lost and found manager
    Route::prefix('lost-and-found-manager')->group(function () {
        Route::get('/',[LostAndFoundManagerController::class,'index'])->name('lfm.dashboard');
        Route::get('/items/create',[LostAndFoundManagerController::class,'createItem'])->name('lfm.items.create');
        Route::post('/items/store',[LostAndFoundManagerController::class,'storeItem'])->name('lfm.items.store');

        Route::get('lost-items/create',[LostAndFoundManagerController::class,'createLost'])->name('lfm.lost.create');
        Route::post('lost-items/store',[LostAndFoundManagerController::class,'storeLost'])->name('lfm.lost.store');

        Route::get('/claims',[LostAndFoundManagerController::class,'verifyClaims'])->name('lfm.claims.index');
        Route::post('/claims/{id}/approve',[LostAndFoundManagerController::class,'approveClaim'])->name('lfm.claims.approve');

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
});
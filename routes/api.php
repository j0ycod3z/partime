<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrumeLabsController;



Route::prefix('trumelabs')->group(function () {
    // USER
    Route::post('/user', [TrumeLabsController::class, 'createUser'])->name('users.store');
    Route::patch('/patch-user/{id}', [TrumeLabsController::class, 'updateUser'])->name('users.update');


    Route::get('/get-user', [TrumeLabsController::class, 'getUser'])->name('users.show');


    // KITS
    Route::get('/unregistered-kits', [TrumeLabsController::class, 'getUnregisteredKits']);

    
    Route::post('/kits/{barcode}/register', [TrumeLabsController::class, 'registerKit']); // TO DO MAY AAYUSIN PA
    Route::patch('/kits/{barcode}', [TrumeLabsController::class, 'updateKit']); // TO DO MAY AAYUSIN PA


    // RESULTS
    Route::get('/results', [TrumeLabsController::class, 'getResults']);//questionable

    // STAGING ONLY (DEV/TESTING)
    Route::post('/generate-kits', [TrumeLabsController::class, 'generateKit']);
    Route::post('/mock-kit-result', [TrumeLabsController::class, 'mockKitResult']);
});

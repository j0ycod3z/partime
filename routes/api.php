<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrumeLabsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes handle backend logic such as creating users, registering kits, etc.
| Frontend JavaScript should make API calls to /api/trumelabs/*
*/

Route::prefix('trumelabs')->group(function () {
    // USER
    Route::post('/user', [TrumeLabsController::class, 'createUser']);
    Route::patch('/user/{id}', [TrumeLabsController::class, 'updateUser']);
    Route::get('/user', [TrumeLabsController::class, 'getUser']);

    // KITS
    Route::get('/unregistered-kits', [TrumeLabsController::class, 'getUnregisteredKits']);
    Route::post('/kits/{barcode}/register', [TrumeLabsController::class, 'registerKit']);
    Route::patch('/kits/{barcode}', [TrumeLabsController::class, 'updateKit']);

    // RESULTS
    Route::get('/results', [TrumeLabsController::class, 'getResults']);

    // STAGING ONLY (DEV/TESTING)
    Route::post('/generate-kits', [TrumeLabsController::class, 'generateKit']);
    Route::post('/mock-kit-result', [TrumeLabsController::class, 'mockKitResult']);
});

<?php

use Leanderklees\Momentum\Http\Controllers\UploadController;

// Route::middleware('auth')->group(function () {
    Route::post('/upload/fp-upload', [UploadController::class, 'fpUpload']);
    Route::delete('/upload/fp-delete', [UploadController::class, 'fpDelete']);
// });

Route::view('momentum', 'momentum::momentum');
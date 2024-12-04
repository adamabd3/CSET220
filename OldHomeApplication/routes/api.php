<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::prefix('patients')->group(function () {
    Route::get('/', [PatientController::class, 'index']);
    Route::get('{id}', [PatientController::class, 'show']);
    Route::post('/', [PatientController::class, 'store']);
    Route::put('{id}', [PatientController::class, 'update']);
});

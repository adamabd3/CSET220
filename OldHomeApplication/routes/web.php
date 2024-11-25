<?php

use App\Http\Controllers\empcontrol;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('newRoster');
});
Route::get('/employee_info', [empcontrol::class, 'index']);

Route::get('/patient_info', [PatientController::class, 'index'])->name('patient_info');


Route::get('/roles', function () {
    return view('rolechange');
});

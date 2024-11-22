<?php

use App\Http\Controllers\empcontrol;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/new-roster', function () {
    return view('newRoster');
});

Route::get('/employee_info', [empcontrol::class, 'index']);

Route::get('/{patientId}/patientOfDoctor', [PatientController::class, 'medsForPatient']);
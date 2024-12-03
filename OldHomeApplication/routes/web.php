<?php

use App\Http\Controllers\empcontrol;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\registerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\patient_info;

Route::get('/new-roster', function () {
    return view('newRoster');
});

Route::get('/employee_info', [empcontrol::class, 'index']);

Route::middleware(['auth:employees'])->group(function () {
    Route::get('/patient_info', [patient_info::class, 'index']);
});

Route::get('/{patientId}/patientOfDoctor', [PatientController::class, 'medsForPatient']);

//registration
Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [registerController::class, 'store'])->name('register');

//login/logout
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::view('pending-approval', 'pending_approval')->name('pending_approval');

//login redirect middleware
Route::get('/admin-dashboard', [DashboardController::class, 'index'])->middleware('auth:employees')->name('admin.dashboard');
Route::get('/supervisor-dashboard', [DashboardController::class, 'index'])->middleware('auth:employees')->name('supervisor.dashboard');
Route::get('/doctor-dashboard', [DashboardController::class, 'index'])->middleware('auth:employees')->name('doctor.dashboard');
Route::get('/caregiver-dashboard', [DashboardController::class, 'index'])->middleware('auth:employees')->name('caregiver.dashboard');
Route::get('/patient-dashboard', [DashboardController::class, 'index'])->middleware('auth:patients')->name('patient.dashboard');


//admin
Route::get('/admin/pending-accounts', [AdminController::class, 'pendingAccounts'])->name('admin.pending');
Route::post('/admin/approve/{type}/{id}', [AdminController::class, 'approveAccount'])->name('admin.approve');
Route::post('/admin/deny/{type}/{id}', [AdminController::class, 'denyAccount'])->name('admin.deny');


//doctor
Route::get('/doctor/patient', [PatientController::class, 'medsForPatient'])->name('doctor.patient')->middleware('auth:employees');


// disregard for now
Route::middleware(['auth:employees'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', function () {
    return view('home');
})->name('home');


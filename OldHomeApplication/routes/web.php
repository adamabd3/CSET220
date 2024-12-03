<?php

use App\Http\Controllers\empcontrol;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\registerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

Route::get('/new-roster', function () {
    return view('newRoster');
});

Route::get('/employee_info', [empcontrol::class, 'index']);

Route::get('/{patientId}/patientOfDoctor', [PatientController::class, 'medsForPatient']);

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [registerController::class, 'store'])->name('register');

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/admin/pending-accounts', [AdminController::class, 'pendingAccounts'])->name('admin.approve');
Route::post('/admin/deny/{type}/{id}', [AdminController::class, 'denyAccount'])->name('admin.deny');

Route::post('/admin/approve-account/{type}/{id}', [AdminController::class, 'approveAccount']);

Route::middleware(['auth', 'check.approval'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
});





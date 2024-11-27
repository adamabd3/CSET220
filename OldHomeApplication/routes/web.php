<?php

use App\Http\Controllers\empcontrol;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\registerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;

Route::get('/new-roster', function () {
    return view('newRoster');
});

Route::get('/employee_info', [empcontrol::class, 'index']);

Route::get('/{patientId}/patientOfDoctor', [PatientController::class, 'medsForPatient']);

Route::get('/', function() {
    return view('register');
});

Route::post('/signup', [registerController::class, 'register'])->name('register');
Route::get('/pending-approval', function () {
    return view('pending_approval');
})->name('pending-approval');

Route::get('/admin/pending-accounts', [AdminController::class, 'pendingAccounts']);
Route::post('/admin/approve-account/{type}/{id}', [AdminController::class, 'approveAccount'])->name('admin.approve');

Route::middleware(['auth', 'check.approval'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');





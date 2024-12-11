<?php

use App\Http\Controllers\empcontrol;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\registerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\FamilyLoginController;
use App\Http\Controllers\patient_info;
use App\Http\Controllers\RosterController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/daily_roster/create', [RosterController::class, 'create'])->name('roster.create');

Route::middleware(['auth:employees'])->group(function () {
    Route::any('/employee_info', [empcontrol::class, 'index']);
});

Route::middleware(['auth:employees'])->group(function () {
    Route::get('/patient_info', [patient_info::class, 'index']);
});

Route::middleware(['auth:employees'])->group(function () {
    Route::any('/daily_roster', [RosterController::class, 'index']);
});
Route::middleware(['auth:patients'])->group(function () {
    Route::any('/daily_roster', [RosterController::class, 'index']);
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
Route::get('/doctor-dashboard', [DoctorController::class, 'dashboard'])->middleware('auth:employees')->name('doctor.dashboard');
Route::get('/caregiver-dashboard', [DashboardController::class, 'index'])->middleware('auth:employees')->name('caregiver.dashboard');
Route::get('/patient-dashboard', [DashboardController::class, 'index'])->middleware('auth:patients')->name('patient.dashboard');


//admin
Route::get('/admin/pending-accounts', [AdminController::class, 'pendingAccounts'])->name('admin.pending');
Route::post('/admin/approve/{type}/{id}', [AdminController::class, 'approveAccount'])->name('admin.approve');
Route::post('/admin/deny/{type}/{id}', [AdminController::class, 'denyAccount'])->name('admin.deny');

//Patient View
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
Route::put('/patients/{patient_id}/update', [PatientController::class, 'update'])->name('patients.update');
Route::get('/patients/{patient_id}/edit', [PatientController::class, 'edit'])->name('patients.edit');

//Family Login
Route::get('family-login', [FamilyLoginController::class, 'showFamilyLoginForm'])->name('family-login');
Route::post('family-login', [FamilyLoginController::class, 'login']);
Route::get('family-logout', [FamilyLoginController::class, 'logout'])->name('family-logout');
Route::get('family-dashboard', [FamilyLoginController::class, 'index'])->name('family-dashboard');

//Supervisor
Route::get('/schedule-appointment', [SupervisorController::class, 'scheduleAppointment'])->name('schedule-appointment');
Route::post('/appointments/store', [SupervisorController::class, 'storeAppointment'])->name('appointments.store');

//payments
Route::get('/admin/payments', [AdminController::class, 'showPaymentsPage'])->name('admin.showPaymentsPage');
Route::post('/admin/payments/update', [AdminController::class, 'updatePayments'])->name('admin.updatePayments');

//doctor
Route::get('/doctor/patient', [PatientController::class, 'medsForPatient'])->name('doctor.patient')->middleware('auth:employees');
Route::post('/doctor/{patientId}/addMed', [PatientController::class, 'storeMed'])->name('doctor.addMed')->middleware('auth:employees');
Route::get('/doctor/appointments/filter', [DoctorController::class, 'getUpcomingAppointments'])->name('doctor.appointments.filter');


// disregard for now
Route::middleware(['auth:employees'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/', function () {
    return view('home');
})->name('home');


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::guard('employees')->check()) {
            $employee = Auth::guard('employees')->user();

            if (!$employee->approved) {
                return redirect()->route('pending_approval');
            }

            switch (strtolower($employee->role)) {
                case 'admin':
                    return view('admin.dashboard');
                case 'supervisor':
                    return view('supervisor.dashboard');
                case 'doctor':
                    return view('doctor.dashboard');
                case 'caregiver':
                    return view('caregiver.dashboard');
                default:
                    return redirect()->route('login')->withErrors(['role' => 'Unauthorized role.']);
            }
        }

        if (Auth::guard('patients')->check()) {
            $patient = Auth::guard('patients')->user();

            if (!$patient->approved) {
                return redirect()->route('pending_approval');
            }

            return view('patient.dashboard', compact('patient'));
        }

        return redirect()->route('login');
    }
}

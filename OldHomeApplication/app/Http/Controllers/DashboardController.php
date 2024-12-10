<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $appointments = DB::table('appointments')
            ->where('patient_id', $patient->patient_id)
            ->first();
            
            $doctor = null;
            $appointment_date = null;
            if ($appointments) {
                $doctor = DB::table('employees')->where('employee_id', $appointments->doctor_id)->first();
                $doctor_name = $doctor ? $doctor->first_name : 'Not assigned a doctor';
                $appointment_date = $appointments->date;
            }

            $medications = DB::table('meds')
                ->where('patient_id', $patient->patient_id)
                ->first();

            $meals = DB::table('meals')
                ->where('patient_id', $patient->patient_id)
                ->first();

            return view('patient.dashboard', [
                'first_name' => $patient->first_name,
                'last_name' => $patient->last_name,
                'patient_id' => $patient->patient_id,
                'emergency_contact' => $patient->emergency_contact,
                'doctor_name' => $doctor ? $doctor->first_name : 'Not assigned a doctor',
                'current_date' => now()->format('F j, Y'),
                'morning' => $medications->med_morning ?? 'N/A',
                'noon' => $medications->med_afternoon ?? 'N/A',
                'night' => $medications->med_night ?? 'N/A',
                'breakfast' => $meals->breakfast ?? 'N/A',
                'lunch' => $meals->lunch ?? 'N/A',
                'dinner' => $meals->dinner ?? 'N/A',
                'appointment_date' => $appointment_date ?? 'N/A',
            ]);
        }

        return redirect()->route('login');
    }
}

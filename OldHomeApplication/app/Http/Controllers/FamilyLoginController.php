<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FamilyLoginController extends Controller
{
    public function showFamilyLoginForm()
    {
        return view('family-login');
    }

    public function login(Request $request)
    {
        $family_code = $request->input('family_code');
        $patient_id = $request->input('patient_id');

        $patient = DB::table('patients')
            ->where('family_code', $family_code)
            ->where('patient_id', $patient_id)
            ->first();
        $appointments = DB::table('appointments')
            ->where('patient_id', $patient_id)
            ->first();
        if ($patient) {
            Session::put('patient_id', $patient->patient_id);
            Session::put('family_code', $patient->family_code);
            Session::put('emergency_contact', $patient->emergency_contact);

            $doctor = null;
            $appointment_date = null;

            if ($appointments) {
                Session::put('doctor_id', $appointments->doctor_id);
                $doctor = DB::table('employees')
                    ->where('employee_id', $appointments->doctor_id)
                    ->first();
                $appointment_date = $appointments->date;
            } else {
                Session::put('doctor_id', null);
            }

            $medications = DB::table('meds')
                ->where('patient_id', $patient->patient_id)
                ->first();

            $meals = DB::table('meals')
                ->where('patient_id', $patient->patient_id)
                ->first();

            return view('family-dashboard', [
                'family_code' => $patient->family_code,
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
        } else {
            return back()->withErrors(['message' => 'Invalid family code or patient ID']);
        }
    }

    public function logout()
    {
        Session::flush();

        return redirect()->route('family-login');
    }
}

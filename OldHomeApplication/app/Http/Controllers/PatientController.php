<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Med;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function medsForPatient(Request $request) {
        $patient_id = $request->input('patient_id'); 

        $patient = Patient::findOrFail($patient_id);

        $meds = Med::where('patient_id', $patient_id)->get();

        return view('doctor.patientOfDoctor', [
            'patient' => $patient,
            'meds' => $meds,
            'currentDate' => now()->toDateString(),
        ]);
    }


    public function store(Request $request, $patient_id, $doctor_id) {
        Med::create([
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
            'date' => now(),
            'comment' => $request->has('comment')
        ]);
    }

    public function storeMed(Request $request, $patientId)
    {

        $doctorId = Auth::guard('employees')->user()->employee_id;

        $request->validate([
            'comment' => 'required|string',
            'med_morning' => 'nullable|boolean',
            'med_afternoon' => 'nullable|boolean',
            'med_night' => 'nullable|boolean',
        ]);

        Med::create([
            'patient_id' => $patientId,
            'doctor_id' => $doctorId,
            'date' => now(),
            'comment' => $request->input('comment'),
            'med_morning' => $request->has('med_morning'),
            'med_afternoon' => $request->has('med_afternoon'),
            'med_night' => $request->has('med_night'),
        ]);

        return redirect()->back()->with('success', 'Prescription added successfully.');
    }
}

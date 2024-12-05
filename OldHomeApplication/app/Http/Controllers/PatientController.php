<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Med;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        Log::info('storeMed called', $request->all());
        
        $doctorId = Auth::guard('employees')->user()->employee_id;

        $validatedData = $request->validate([
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
            'med_morning' => $request->boolean('med_morning'),   // Correctly handling boolean
            'med_afternoon' => $request->boolean('med_afternoon'), // Correctly handling boolean
            'med_night' => $request->boolean('med_night'),       // Correctly handling boolean
        ]);

        Log::info('Prescription created successfully');

        return redirect()->back()->with('success', 'Prescription added successfully.');
    }
}

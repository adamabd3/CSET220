<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Med;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function medsForPatient(Request $request)
{
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
}

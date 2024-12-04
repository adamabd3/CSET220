<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Med;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function medsForPatient($patient_id) {
        $patient = Patient::find($patient_id);

        $meds = Med::where('patient_id', $patient_id)
                    ->get();
        
        return view('patientOfDoctor', [
            'patient' => $patient,
            'meds' => $meds,
            'currentDate' => now()->toDateString()
        ]);
    }

    public function index()
    {
        $patients = Patient::all();
        return view('patient.index', compact('patients'));
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return response()->json($patient);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePatient($request);
        $patient = Patient::create($validated);
        return response()->json($patient, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validatePatient($request);
        $patient = Patient::findOrFail($id);
        $patient->update($validated);
        return response()->json($patient);
    }

    private function validatePatient(Request $request)
    {
        return $request->validate([
            'patient_id' => 'required|integer',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:70|unique:patients,email,' . $request->patient_id,
            'phone' => 'required|string|max:30',
            'dob' => 'required|date',
            'family_code' => 'required|string|max:50',
            'emergency_contact' => 'required|string|max:100',
            'relation_to_contact' => 'required|string|max:100',
            'approved' => 'required|boolean',
        ]);
    }
}
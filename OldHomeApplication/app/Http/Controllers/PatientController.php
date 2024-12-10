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
    public function medsForPatient(Request $request, $patient_id = null)
    {
        $patient_id = $patient_id ?? $request->input('patient_id');

        if (!$patient_id) {
            return redirect()->back()->withErrors(['error' => 'Patient ID is required.']);
        }

        $patient = Patient::findOrFail($patient_id);

        $meds = Med::where('patient_id', $patient_id)->get();

        return view('doctor.patientOfDoctor', [
            'patient' => $patient,
            'meds' => $meds,
            'currentDate' => now()->toDateString(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePatient($request);
        $patient = Patient::create($validated);
        return response()->json($patient, 201);
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
            'med_morning' => $request->boolean('med_morning'),
            'med_afternoon' => $request->boolean('med_afternoon'),
            'med_night' => $request->boolean('med_night'),
        ]);

        Log::info('Prescription created successfully');

        return redirect()->back()->with('success', 'Prescription added successfully.');
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

    public function update(Request $request, $id)
    {
        $validated = $this->validatePatient($request);
    
        $patient = Patient::findOrFail($id);
    
        dd($patient);
    
        $patient->update($validated);
    
        dd("Patient updated!");
    
        return redirect()->route('patients.index')->with('success', 'Patient updated successfully!');
    }

    public function edit($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        return view('patient.edit', compact('patient'));
    }

    private function validatePatient(Request $request)
    {
        return $request->validate([
            'patient_id' => 'required|integer',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:70|unique:patients,email,' . $request->patient_id . ',patient_id',
            'phone' => 'required|string|max:30',
            'dob' => 'required|date',
            'family_code' => 'required|string|max:50',
            'emergency_contact' => 'required|string|max:100',
            'relation_to_contact' => 'required|string|max:100',
            'approved' => 'required|boolean',
        ]);
    }
}

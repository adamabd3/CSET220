<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class registerController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email|unique:employees,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,supervisor,doctor,caregiver,patient',
            'dob' => 'required|date',
            'family_code' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'relation_to_contact' => 'nullable|string|max:255',
        ]);

        if ($request->role == 'patient') {
            $patient = new Patient();
            $patient->first_name = $request->first_name;
            $patient->last_name = $request->last_name;
            $patient->email = $request->email;
            $patient->phone = $request->phone;
            $patient->password = Hash::make($request->password);
            $patient->dob = $request->dob;
            $patient->family_code = $request->family_code;
            $patient->emergency_contact = $request->emergency_contact;
            $patient->relation_to_contact = $request->relation_to_contact;
            $patient->approved = false;
            $patient->save();

            return redirect()->route('pending-approval')->with('success', 'Your account has been created as a patient. You will be able to log in once approved by an admin.');
        }

        if (in_array($request->role, ['admin', 'supervisor', 'doctor', 'caregiver'])) {
            $employee = new employee();
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->password = Hash::make($request->password);
            $employee->dob = $request->dob;
            $employee->role = $request->role;
            $employee->approved = false;
            $employee->save();

            return redirect()->route('pending-approval')->with('success', 'Your account has been created as an employee. You will be able to log in once approved by an admin.');
        }
    }
}



<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'role' => 'required|string',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|min:10',
        'password' => 'required|confirmed|min:8',
        'dob' => 'required|date',
        'family_code' => 'nullable|string',
        'emergency_contact' => 'nullable|string',
        'relation_to_contact' => 'nullable|string',
    ]);

    $hashedPassword = Hash::make($validated['password']);

    if ($request->role === 'patient') {
        Patient::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'dob' => $validated['dob'],
            'family_code' => $validated['family_code'],
            'emergency_contact' => $validated['emergency_contact'],
            'relation_to_contact' => $validated['relation_to_contact'],
            'password' => $hashedPassword,
        ]);
    } else {
        employee::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'dob' => $validated['dob'],
            'role' => $validated['role'],
            'password' => $hashedPassword,
        ]);
    }

    return redirect()->route('register')->with('success', 'Registration successful!');
}
}




<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\employee;

class AdminController extends Controller
{
    public function pendingAccounts()
    {
    $pendingPatients = Patient::where('approved', false)->get();
    $pendingEmployees = employee::where('approved', false)->get();

    $newUser = session()->get('new_user', null);

    return view('admin.pending_account', compact('pendingPatients', 'pendingEmployees', 'newUser'));
    }

    public function approveAccount($type, $id, Request $request)
{
    if ($type === 'patient') {
        $patient = Patient::findOrFail($id);
        $patient->approved = true;
        $patient->save();
    } elseif ($type === 'employee') {
        $employee = employee::findOrFail($id);
        $employee->approved = true;
        $employee->save();
    }

    return redirect()->back()->with('success', ucfirst($type) . ' account approved successfully.');
}

public function denyAccount($type, $id, Request $request)
{
    if ($type === 'patient') {
        $patient = Patient::findOrFail($id);
        $patient->delete();

    } elseif ($type === 'employee') {
        $employee = employee::findOrFail($id);
        $employee->delete();
    }

    return redirect()->back()->with('success', ucfirst($type) . ' account denied successfully.');
}
}


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
        $employee = Employee::findOrFail($id);
        $employee->approved = true;
        $employee->save();
    }

    return redirect()->back()->with('success', ucfirst($type) . ' account approved successfully.');
}
}

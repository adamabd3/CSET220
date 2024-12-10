<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\employee;
use App\Models\Payment;
use Carbon\Carbon;

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

public function updatePayments()
{
    $today = Carbon::today();
    $patients = Patient::with('appointments', 'medicines')->get();

    foreach ($patients as $patient) {
        $payment = $patient->payment ?: new Payment();
        
        if (!$payment->exists) {
            $payment->patient_id = $patient->id;
            $payment->total_due = 0;
            $payment->last_update = $today;
            $payment->save();
        }

        if ($payment->last_update != $today) {
            $daysSinceLastUpdate = $today->diffInDays(Carbon::parse($payment->last_update));

            $dailyCharge = $daysSinceLastUpdate * 10;
            $appointmentCharge = $patient->appointments->count() * 50;
            $medicineCharge = $patient->medicines->count() * 5;

            $totalDue = $payment->total_due + $dailyCharge + $appointmentCharge + $medicineCharge;

            $payment->total_due = $totalDue;
            $payment->last_update = $today;
            $payment->save();
        }
    }

    return redirect()->back()->with('success', 'Payments updated successfully');
}

public function showPaymentsPage()
{
    $patients = Patient::with('payment')->get();

    return view('admin.payments', compact('patients'));
}
}


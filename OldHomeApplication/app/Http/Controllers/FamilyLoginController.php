<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FamilyLoginController extends Controller
{
    public function showFamilyLoginForm()
    {
        return view('family-login');
    }

    public function login(Request $request)
    {
        $family_code = $request->input('family_code');
        $patient_id = $request->input('patient_id');

        $patient = DB::table('patients')
            ->where('family_code', $family_code)
            ->where('patient_id', $patient_id)
            ->first();

        if ($patient) {
            Session::put('patient_id', $patient->patient_id);
            Session::put('family_code', $patient->family_code);

            return view('family-dashboard', [
                'family_code' => $patient->family_code,
                'patient_id' => $patient->patient_id,
                'current_date' => now()->format('F j, Y'),
            ]);
        } else {
            return back()->withErrors(['message' => 'Invalid family code or patient ID']);
        }
    }

    public function logout()
    {
        Session::flush();

        return redirect()->route('family-login');
    }
}

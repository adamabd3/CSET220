<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\patient;

class patient_info extends Controller
{

    public function index(Request $request){
        // $patients = patient::all();
        $search = $request->input('search');
        if ($search) {
            $patients = patient::where('patient_id', 'like', '%' . $search . '%')->
            orWhere('first_name', 'like', '%' . $search . '%')->
            orWhere('last_name', 'like', '%' . $search . '%')->
            orWhere('email', 'like', '%' . $search . '%')->
            orWhere('dob', 'like', '%' . $search . '%')->
            orWhere('admission_date', 'like', '%' . $search . '%')->
            orWhere('emergency_contact', 'like', '%' . $search . '%')->
            orWhere('relation_to_contact', 'like', '%' . $search . '%')->
            orWhere('phone', 'like', '%' . $search . '%')->get();
        } else {
            $patients = patient::all();
        }
        return view('patientList', compact('patients'));
    }}


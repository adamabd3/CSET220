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
    }
}

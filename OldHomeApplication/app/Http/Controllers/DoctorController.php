<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DoctorController extends Controller
{
    public function dashboard(Request $request)
    {
        $doctorId = Auth::guard('employees')->user()->employee_id;

        $filterDate = $request->input('filter_date', null);

        $appointments = DB::table('appointments')
            ->join('patients', 'appointments.patient_id', '=', 'patients.patient_id')
            ->join('meds', function ($join) use ($doctorId) {
                $join->on('appointments.patient_id', '=', 'meds.patient_id')
                     ->where('meds.doctor_id', '=', $doctorId);
            })
            ->where('appointments.doctor_id', $doctorId)
            ->whereDate('appointments.date', '<', now())
            ->select(
                'patients.first_name',
                'patients.last_name',
                'appointments.date',
                'meds.comment',
                'meds.med_morning',
                'meds.med_afternoon',
                'meds.med_night'
            )
            ->orderBy('appointments.date', 'desc')
            ->get();
        
        if (!$filterDate) {
            $upcomingAppointments = DB::table('appointments')
                ->join('patients', 'appointments.patient_id', '=', 'patients.patient_id')
                ->where('appointments.doctor_id', $doctorId)
                ->whereDate('appointments.date', '>', now())
                ->select(
                    'patients.first_name',
                    'patients.last_name',
                    'appointments.date'
                )
                ->get();
        } else {
            $filterDate = Carbon::parse($filterDate)->format('Y-m-d');
            
            $upcomingAppointments = DB::table('appointments')
                ->join('patients', 'appointments.patient_id', '=', 'patients.patient_id')
                ->where('appointments.doctor_id', $doctorId)
                ->whereDate('appointments.date', '>', now())
                ->whereDate('appointments.date', '<=', $filterDate)
                ->select(
                    'patients.first_name',
                    'patients.last_name',
                    'appointments.date'
                )
                ->get();
        }

        return view('doctor.dashboard', [
            'appointments' => $appointments,
            'upcomingAppointments' => $upcomingAppointments,
            'filterDate' => $filterDate,
        ]);
    }
}
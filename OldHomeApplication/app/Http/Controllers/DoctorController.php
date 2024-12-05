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

        // Get the selected filter date from the request, default to today if no date is provided
        $filterDate = $request->input('filter_date', null); // Default to null to show all appointments

        // Get all past appointments
        $appointments = DB::table('appointments')
            ->join('patients', 'appointments.patient_id', '=', 'patients.patient_id')
            ->join('meds', function ($join) use ($doctorId) {
                $join->on('appointments.patient_id', '=', 'meds.patient_id')
                     ->where('meds.doctor_id', '=', $doctorId);
            })
            ->where('appointments.doctor_id', $doctorId)
            ->whereDate('appointments.date', '<', now()) // Past appointments
            ->select(
                'patients.first_name',
                'patients.last_name',
                'appointments.date',
                'meds.comment',
                'meds.med_morning',
                'meds.med_afternoon',
                'meds.med_night'
            )
            ->orderBy('appointments.date', 'desc') // Sort by the most recent first
            ->get();
        
        // For upcoming appointments:
        // If no filter date is provided, show all upcoming appointments
        if (!$filterDate) {
            $upcomingAppointments = DB::table('appointments')
                ->join('patients', 'appointments.patient_id', '=', 'patients.patient_id')
                ->where('appointments.doctor_id', $doctorId)
                ->whereDate('appointments.date', '>', now()) // Only future appointments
                ->select(
                    'patients.first_name',
                    'patients.last_name',
                    'appointments.date'
                )
                ->get();
        } else {
            // If a filter date is provided, show upcoming appointments until the selected date
            $filterDate = Carbon::parse($filterDate)->format('Y-m-d');
            
            $upcomingAppointments = DB::table('appointments')
                ->join('patients', 'appointments.patient_id', '=', 'patients.patient_id')
                ->where('appointments.doctor_id', $doctorId)
                ->whereDate('appointments.date', '>', now()) // Only future appointments
                ->whereDate('appointments.date', '<=', $filterDate) // Filter by the selected date
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
            'filterDate' => $filterDate, // Send the filter date to the view to keep track of it
        ]);
    }
}
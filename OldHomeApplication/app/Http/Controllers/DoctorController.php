<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DoctorController extends Controller
{
    public function dashboard(Request $request)
    {
        $doctorId = Auth::guard('employees')->user()->employee_id ?? null;

        if (!$doctorId) {
            abort(403, "Unauthorized access. Doctor not logged in.");
        }

        $filterDate = $request->input('filter_date', null);

        // Fetch past appointments
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

        // Fetch upcoming appointments
        $upcomingAppointmentsQuery = DB::table('appointments')
            ->join('patients', 'appointments.patient_id', '=', 'patients.patient_id')
            ->where('appointments.doctor_id', $doctorId)
            ->whereDate('appointments.date', '>', now())
            ->select('patients.first_name', 'patients.last_name', 'appointments.date');

        if ($filterDate) {
            $filterDate = Carbon::parse($filterDate)->format('Y-m-d');
            $upcomingAppointmentsQuery->whereDate('appointments.date', '<=', $filterDate);
        }

        $upcomingAppointments = $upcomingAppointmentsQuery->get();

        // Debugging outputs
        Log::debug('Past Appointments:', ['appointments' => $appointments->toArray()]);
        Log::debug('Upcoming Appointments:', ['upcomingAppointments' => $upcomingAppointments->toArray()]);

        return view('doctor.dashboard', [
            'appointments' => $appointments,
            'upcomingAppointments' => $upcomingAppointments,
            'filterDate' => $filterDate,
        ]);
    }
}
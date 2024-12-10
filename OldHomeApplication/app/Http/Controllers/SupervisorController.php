<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Roster;
use App\Models\Employee;

class SupervisorController extends Controller
{
    public function scheduleAppointment(Request $request)
    {
        // Check if this is an AJAX request for JSON data
        if ($request->ajax()) {
            $selectedDate = $request->input('date');  // Get the selected date from the query string
        
            if (!$selectedDate) {
                logger("No date received in the request."); // Log missing date
                return response()->json(['doctor' => null]);
            }
        
            logger("Selected Date: $selectedDate");
        
            // Fetch roster for the selected date
            $roster = Roster::whereDate('date', $selectedDate)->first();
        
            if ($roster) {
                logger("Roster found: " . json_encode($roster));
            } else {
                logger("No roster found for the selected date.");
            }
        
            $doctor = $roster ? Employee::find($roster->doctor_id) : null;
        
            return response()->json([
                'doctor' => $doctor ? [
                    'first_name' => $doctor->first_name,
                    'last_name' => $doctor->last_name,
                ] : null,
            ]);
        }

        // Otherwise, load the Blade view
        return view('supervisor/newAppointment');
    }
}
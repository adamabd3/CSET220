<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\roster;
use App\Models\employee;

class RosterController extends Controller
{
    public function index(Request $request)
    {
        $doctor = employee::where('role', 'Doctor')->get();
        $supervisor = employee::where('role', 'Supervisor')->get();
        $caregiver = employee::where('role', 'Caregiver')->get();

        $date = $request->input('date', '2024-11-18');
        $roster = Roster::where('date', $date)->get();
        return view('dailyrost', compact('roster','doctor','supervisor','caregiver'));

        }
    
    
    public function create(Request $request)
        {
            $request->validate([
                'new_date' => 'required|date',
                'new_doctor' => 'required|integer',
                'new_supervisor' => 'required|integer',
                'new_caregiver1' => 'required|integer',
                'new_caregiver2' => 'required|integer',
                'new_caregiver3' => 'required|integer',
                'new_caregiver4' => 'required|integer',
            ]);
        
            roster::create([
                'date' => $request->input('new_date'),
                'doctor_id' => $request->input('new_doctor'),
                'supervisor_id' => $request->input('new_supervisor'),
                'caregiver1_id' => $request->input('new_caregiver1'),
                'caregiver2_id' => $request->input('new_caregiver2'),
                'caregiver3_id' => $request->input('new_caregiver3'),
                'caregiver4_id' => $request->input('new_caregiver4'),
            ]);
        
            return redirect('daily_roster');
        }

    }
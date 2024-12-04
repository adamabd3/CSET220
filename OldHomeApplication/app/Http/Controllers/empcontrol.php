<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class empcontrol extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $employeeIds = $request->input('employee_id', []);
            $firstNames = $request->input('first_name', []);
            $lastNames = $request->input('last_name', []);
            $roles = $request->input('role', []);
            $salaries = $request->input('salary', []);
            $emails = $request->input('email', []);
            $phones = $request->input('phone', []);
            $dobs = $request->input('dob', []);

            foreach ($employeeIds as $index => $id) {
                $employee = employee::find($id);
                if ($employee) {
                    $employee->first_name = $firstNames[$index];
                    $employee->last_name = $lastNames[$index];
                    $employee->role = $roles[$index];
                    $employee->salary = $salaries[$index];
                    $employee->email = $emails[$index];
                    $employee->phone = $phones[$index];
                    $employee->dob = $dobs[$index];
                    $employee->save();
                }
            }
        }

        $Esearch = $request->input('Esearch');
        $Nsearch = $request->input('Nsearch');
        $Ssearch = $request->input('Ssearch');
        $Rsearch = $request->input('Rsearch');
        $Dsearch = $request->input('Dsearch');
        $EMsearch = $request->input('EMsearch');
        $Psearch = $request->input('Psearch');

        if ($Esearch) {
            $employee = employee::where('employee_id', 'like', '%' . $Esearch . '%')->get();
        } elseif ($Ssearch) {
            $employee = employee::where('salary', '>', $Ssearch)->get();
        } elseif ($Nsearch) {
            $employee = employee::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $Nsearch . '%')->get();
        } elseif ($Rsearch) {
            $employee = employee::where('role', 'like', '%' . $Rsearch . '%')->get();
        } elseif ($Dsearch) {
            $employee = employee::where('DOB', 'like', '%' . $Dsearch . '%')->get();
        } elseif ($EMsearch) {
            $employee = employee::where('Email', 'like', '%' . $EMsearch . '%')->get();
        } elseif ($Psearch) {
            $employee = employee::where('Phone', 'like', '%' . $Psearch . '%')->get();
        } else {
            $employee = employee::all();
        }

        return view('emplist', ['employee' => $employee]);
    }
}

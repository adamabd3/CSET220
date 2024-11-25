<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class empcontrol extends Controller
{
    public function index(Request $request){
        $Esearch = $request->input('Esearch');
        $Nsearch = $request->input('Nsearch');
        $Ssearch = $request->input('Ssearch');
        $Rsearch = $request->input('Rsearch');
        $Dsearch = $request->input('Dsearch');
        $EMsearch = $request->input('EMsearch');
        $Psearch = $request->input('Psearch');

        if($Esearch){
            $employee = employee::where('employee_id', 'like','%'. $Esearch . '%')->get();
        }
        elseif($Ssearch){
            $employee = employee::where('salary', '>', $Ssearch)->get();
        }
        elseif($Nsearch){
            $employee = Employee::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $Nsearch . '%')->get();
            }
        elseif($Rsearch){
            $employee = employee::where('role', 'like','%'. $Rsearch . '%')->get();
        }
        elseif($Dsearch){
            $employee = employee::where('DOB', 'like','%'. $Dsearch . '%')->get();
        }
        elseif($EMsearch){
            $employee = employee::where('Email', 'like','%'. $EMsearch . '%')->get();
        }
        elseif($Psearch){
            $employee = employee::where('Phone', 'like','%'. $Psearch . '%')->get();
        }
        else{
            $employee = employee::all();
        }
        return view('emplist', ['employee' => $employee]);
    }
}

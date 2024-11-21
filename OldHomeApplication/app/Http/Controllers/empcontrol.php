<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\employee;
use Illuminate\Http\Request;

class empcontrol extends Controller
{
    public function index(){
        $employee = employee::all();

        return view('emplist', ['employee' => $employee]);
    }
}

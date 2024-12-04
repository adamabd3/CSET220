<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\roster;

class RosterController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', '2024-11-18');
        $roster = Roster::where('date', $date)->get();
        return view('dailyrost', compact('roster'));
    }
}

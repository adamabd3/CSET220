<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = employee::all();
        return view('employees.index', compact('employees'));
    }

    public function show($id)
    {
        $employee = employee::findOrFail($id);
        return response()->json($employee);
    }

    public function store(Request $request)
    {
        $validated = $this->validateEmployee($request);
        $employee = employee::create($validated);
        return response()->json($employee, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateEmployee($request);
        $employee = employee::findOrFail($id);
        $employee->update($validated);
        return response()->json($employee);
    }

    private function validateEmployee(Request $request)
    {
        return $request->validate([
            'employee_id' => 'required|integer',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:70|unique:employees,email,' . $request->employee_id,
            'phone' => 'required|string|max:30',
            'dob' => 'required|date',
            'role' => 'required|in:Admin,Supervisor,Doctor,Caregiver',
            'salary' => 'nullable|integer',
            'approved' => 'required|boolean',
        ]);
    }
}

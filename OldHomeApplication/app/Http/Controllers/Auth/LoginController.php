<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\employee;
use App\Models\Patient;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('employees')->attempt($credentials)) {
            $employee = Auth::guard('employees')->user();

            if (!$employee->approved) {
                Auth::guard('employees')->logout();
                return redirect()->route('pending_approval');
            }

            return $this->redirectToRoleDashboard($employee);
        }

        if (Auth::guard('patients')->attempt($credentials)) {
            $patient = Auth::guard('patients')->user();

            if (!$patient->approved) {
                Auth::guard('patients')->logout();
                return redirect()->route('pending_approval');
            }

            return redirect()->route('patient.dashboard');
        }

        return back()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    /**
     * Redirect user to the appropriate dashboard based on role.
     *
     * @param employee $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToRoleDashboard(employee $employee)
{
    if ($employee->role === 'Admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($employee->role === 'Supervisor') {
        return redirect()->route('supervisor.dashboard');
    } elseif ($employee->role === 'Doctor') {
        return redirect()->route('doctor.dashboard');
    } elseif ($employee->role === 'Caregiver') {
        return redirect()->route('caregiver.dashboard');
    } else {
        \Log::warning("Unhandled role: {$employee->role}");
        return redirect()->route('login')->withErrors(['role' => 'Unauthorized role.']);
    }
}


public function logout()
{
    if (Auth::guard('employees')->check()) {
        Auth::guard('employees')->logout();
    }

    if (Auth::guard('patients')->check()) {
        Auth::guard('patients')->logout();
    }

    return redirect()->route('login');
}
}


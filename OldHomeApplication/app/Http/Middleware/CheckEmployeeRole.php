<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEmployeeRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $employee = Auth::guard('employees')->user();

        if ($employee->role !== $role) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}


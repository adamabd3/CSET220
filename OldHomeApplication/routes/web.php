<?php

use App\Http\Controllers\empcontrol;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/employee_info', [empcontrol::class, 'index']);
});

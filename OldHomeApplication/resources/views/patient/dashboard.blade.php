@extends('layouts.app')

@section('title', 'Patient Dashboard')

@section('content')
    <div class="container">
        <h1>Patient Dashboard</h1>
        <p><strong>Welcome:</strong> {{ $first_name }} {{ $last_name }}</p>
        <p><strong>Current Date:</strong> {{ $current_date }}</p>
        <p><strong>Patient ID:</strong> {{ $patient_id }}</p>
        <p><strong>Doctor Name:</strong> {{ $doctor_name }}</p>
        <p><strong>Appointment on:</strong> {{ $appointment_date }} <br></p>
        <br>
        <h4>Ask your caregiver to update if needed</h4>
        <p><strong>Morning:</strong> <br>
        Morning Medicine: <input type="checkbox" disabled {{ $morning == 1 ? 'checked' : '' }}> 
        <br>
        Breakfast <input type="checkbox" disabled {{ $breakfast == 1 ? 'checked' : '' }}>

        </p>

        <p><strong>Afternoon:</strong> <br>
        Afternoon Medicine: <input type="checkbox" disabled {{ $noon == 1 ? 'checked' : '' }}> <br>
        Lunch <input type="checkbox" disabled {{ $lunch == 1 ? 'checked' : '' }}>        
        </p>

        <p><strong>Night:</strong><br>
        Night Medicine: <input type="checkbox" disabled {{ $night == 1 ? 'checked' : '' }}> <br>
        Dinner <input type="checkbox" disabled {{ $dinner == 1 ? 'checked' : '' }}>
        </p>


    </div>
@endsection
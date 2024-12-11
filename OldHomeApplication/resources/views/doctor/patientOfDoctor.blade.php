@extends('layouts.app')

@section('patientOfDoctor', 'Patient of Doctor')

@section('content')
<div class="container">
    <h1>Patient of Doctor:</h1>
    <h2>{{ $patient->first_name }}</h2>
    <p>{{ $currentDate }}</p>

    <h3>Prescription:</h3>
    <table class="patient-table">
        <thead>
            <tr>
                <th>Comment</th>
                <th>Morning</th>
                <th>Afternoon</th>
                <th>Night</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meds as $med)
                <tr>
                    <td>{{ $med->comment }}</td>
                    <td>{{ $med->med_morning ? 'Yes' : 'No' }}</td>
                    <td>{{ $med->med_afternoon ? 'Yes' : 'No' }}</td>
                    <td>{{ $med->med_night ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>New Prescription:</h3>
    <form action="{{ route('doctor.addMed', ['patientId' => $patient->patient_id]) }}" method="POST" class="styled-form">
        @csrf
        <div class="form-group">
            <label for="comment">Comment:</label>
            <input type="text" id="comment" name="comment" class="form-input" placeholder="Enter comment" required>
        </div>

        <div class="form-group">
            <label for="med_morning">Morning Med:</label>
            <input type="checkbox" id="med_morning" name="med_morning" value="1">
        </div>
        
        <div class="form-group">
            <label for="med_afternoon">Afternoon Med:</label>
            <input type="checkbox" id="med_afternoon" name="med_afternoon" value="1">
        </div>
        
        <div class="form-group">
            <label for="med_night">Night Med:</label>
            <input type="checkbox" id="med_night" name="med_night" value="1">
        </div>

        <div class="form-buttons">
            <button class="btn btn-sharp" type="submit">Submit</button>
            <button class="btn btn-sharp" type="reset">Clear</button>
        </div>
    </form>

    <a href="{{ route('doctor.dashboard') }}" class="btn btn-sharp">Back to Dashboard</a>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif
</div>

<style>
    .container {
        padding: 20px;
    }

    .patient-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 1rem;
        text-align: left;
    }

    .patient-table th, .patient-table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
    }

    .patient-table th {
        background-color: #4267b2;
        color: #ffffff;
        text-transform: uppercase;
        font-weight: bold;
    }

    .patient-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .patient-table tr:hover {
        background-color: #e6efff;
    }

    .styled-form {
        margin-top: 20px;
        font-size: 1rem;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #4267b2;
    }

    .form-input {
        width: 100%;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .form-buttons {
        margin-top: 20px;
    }

    .btn {
        font-family: 'Arial', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        padding: 10px 20px;
        border: 2px solid #4267b2;
        background-color: #ffffff;
        color: #4267b2;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        display: inline-block;
        margin-right: 10px;
        text-decoration: none;
    }

    .btn-sharp {
        border-radius: 0;
    }

    .btn:hover {
        background-color: #4267b2;
        color: #ffffff;
        transform: scale(1.05);
        border-color: #365899;
    }
</style>
@endsection
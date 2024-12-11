@extends('layouts.app')

@section('title', 'Doctor Dashboard')

@section('content')
    <div class="container">
        <h1>Doctor Dashboard</h1>
        <form action="{{ route('doctor.patient') }}" method="GET">
            @csrf
            <label for="patient_id">Enter Patient ID:</label>
            <input type="text" name="patient_id" id="patient_id" required placeholder="Enter Patient ID">
            <button class="btn btn-sharp" type="submit">Patient</button>
        </form>
        <br>

        <h3>Past Appointments:</h3>
        <table class="patient-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date</th>
                    <th>Comment</th>
                    <th>Morning Medication</th>
                    <th>Afternoon Medication</th>
                    <th>Night Medication</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments ?? [] as $appointment)
                    <tr>
                        <td>{{ $appointment->first_name }}</td>
                        <td>{{ $appointment->last_name }}</td>
                        <td>{{ $appointment->date }}</td>
                        <td>{{ $appointment->comment }}</td>
                        <td>{{ $appointment->med_morning ? 'Yes' : 'No' }}</td>
                        <td>{{ $appointment->med_afternoon ? 'Yes' : 'No' }}</td>
                        <td>{{ $appointment->med_night ? 'Yes' : 'No' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <br>

        <h3>Upcoming Appointments</h3>
        <form action="{{ route('doctor.dashboard') }}" method="GET">
            @csrf
            <label for="filter_date">Filter appointments until:</label>
            <input type="date" name="filter_date" id="filter_date" value="{{ $filterDate ?? now()->toDateString() }}">
            <button class="btn btn-sharp" type="submit">Filter</button>
        </form>
        
        <table class="patient-table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($upcomingAppointments ?? [] as $upcoming)
                    <tr>
                        <td>{{ $upcoming->first_name }}</td>
                        <td>{{ $upcoming->last_name }}</td>
                        <td>{{ $upcoming->date }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No upcoming appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
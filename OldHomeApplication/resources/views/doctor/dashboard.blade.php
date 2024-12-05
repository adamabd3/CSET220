@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Doctor Dashboard</h1>
        <form action="{{ route('doctor.patient') }}" method="GET">
            @csrf
            <label for="patient_id">Enter Patient ID:</label>
            <input type="text" name="patient_id" id="patient_id" required placeholder="Enter Patient ID">
            <button type="submit">Patient</button>
        </form>
        <br>

        <h3>Past Appointments:</h3>
        <table>
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
                @forelse ($appointments as $appointment)
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
            <button type="submit">Filter</button>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($upcomingAppointments as $upcoming)
                    <tr>
                        <td>{{ $upcoming->first_name }}</td>
                        <td>{{ $upcoming->last_name }}</td>
                        <td>{{ $upcoming->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
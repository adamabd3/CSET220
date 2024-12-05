@extends('layouts.app')

@section('patientOfDoctor', 'Patient of Doctor')

@section('content')
<h1>Patient of Doctor:</h1>
<h2>{{ $patient->first_name }}</h2>
<p>{{ $currentDate }}</p>
<h3>Prescription:</h3>
<table>
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
<form action="{{ route('doctor.addMed', ['patientId' => $patient->patient_id]) }}" method="POST">
    @csrf
    <label>Comment:</label>
    <input type="text" name="comment" required><br>

    <label>Morning Med:</label>
    <input type="checkbox" name="med_morning"><br>

    <label>Afternoon Med:</label>
    <input type="checkbox" name="med_afternoon"><br>

    <label>Night Med:</label>
    <input type="checkbox" name="med_night"><br>

    <button type="submit">Submit</button>
    <button type="reset">Clear</button>
</form>


<a href="{{ route('doctor.dashboard') }}" class="btn">Back to Dashboard</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@endsection
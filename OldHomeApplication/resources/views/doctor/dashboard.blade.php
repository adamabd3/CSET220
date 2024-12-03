@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Doctor Dashboard</h1>
        <form action="{{ route('doctor.patient') }}" method="GET">
            @csrf
            <label for="patient_id">Enter Patient ID:</label>
            <input type="text" name="patient_id" id="patient_id" required placeholder="Enter Patient ID">>
            <button type="submit">Patient</button>
        </form>
    </div>
@endsection
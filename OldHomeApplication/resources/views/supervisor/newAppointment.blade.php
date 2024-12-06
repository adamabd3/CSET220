@extends('layouts.app')

@section('title', 'New Appointment')

@section('content')
    <div class="container">
        <h1>New Appointment</h1>
        <form action="{{ route('appointments.store') }}" method="GET">
            @csrf
            <label>Patient ID:</label>
            <input type="text" name="patientID" required><br>

            <label>Date:</label>
            <input type="date" name="date" required><br>

            <label>Doctor:</label>
            <input list="doctors" name="doctor" required><br>
            <datalist id="doctors">
                <option value="Dr. Nigel"></option>
            </datalist>
        </form>
    </div>
@endsection
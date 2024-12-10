@extends('layouts.app')

@section('title', 'New Appointment')

@section('content')
    <div class="container">
        <h1>New Appointment</h1>
        <form action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <label>Patient ID:</label>
            <input type="text" name="patientID" required><br>

            <label>Date:</label>
            <input type="date" name="date" id="appointment-date" required><br>

            <label>Doctor:</label>
            <input list="doctors" name="doctor" id="doctor" required><br>
            <datalist id="doctors">
                <option value="Nigel Haralam"></option>
            </datalist>

            <button type="submit">Submit</button>

            <button type="button" onclick="window.history.back()">Go Back</button>
        </form>
    </div>     
@endsection
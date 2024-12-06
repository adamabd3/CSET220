@extends('layouts.app')

@section('title', 'Family Dashboard')

@section('content')
    <div class="container">
        <h1>Family Dashboard</h1>
        <p><strong>Current Date:</strong> {{ $current_date }}</p>
        <p><strong>Family Code:</strong> {{ $family_code }}</p>
        <p><strong>Patient ID:</strong> {{ $patient_id }}</p>
    </div>
@endsection
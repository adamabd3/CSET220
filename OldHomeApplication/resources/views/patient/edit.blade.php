@extends('layouts.app')

@section('title', 'Edit Patient')

@section('content')
<div class="container">
    <h1>Edit Patient</h1>
    
    <form method="POST" action="{{ route('patients.update', $patient->patient_id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="patient_id">Patient ID</label>
            <input type="text" id="patient_id" name="patient_id" class="form-control" value="{{ $patient->patient_id }}" readonly>
        </div>

        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', $patient->first_name) }}" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', $patient->last_name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $patient->email) }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $patient->phone) }}" required>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" class="form-control" value="{{ old('dob', $patient->dob) }}" required>
        </div>

        <div class="form-group">
            <label for="group_number">Group Number</label>
            <input type="text" id="group_number" name="group_number" class="form-control" value="{{ old('group_number', $patient->group_number) }}" required>
        </div>

        <div class="form-group">
            <label for="admission_date">Admission Date</label>
            <input type="date" id="admission_date" name="admission_date" class="form-control" value="{{ old('admission_date', $patient->admission_date) }}" required>
        </div>

        <div class="form-group">
            <label for="approved">Approved</label>
            <input type="checkbox" id="approved" name="approved" class="form-control" {{ $patient->approved ? 'checked' : '' }}>
        </div>

        <button type="submit" class="btn btn-primary">Update Patient</button>
    </form>
</div>
@endsection

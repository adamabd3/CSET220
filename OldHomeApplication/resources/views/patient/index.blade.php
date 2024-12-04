@extends('layouts.app')

@section('title', 'Patients')

@section('content')
<div class="container">
    <h1>Patients</h1>

    @if($patients->isEmpty())
        <p>No patients found.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>DOB</th>
                <th>Group</th>
                <th>Admission Date</th>
                <th>Approved</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->patient_id }}</td>
                <td>{{ $patient->first_name }}</td>
                <td>{{ $patient->last_name }}</td>
                <td>{{ $patient->email }}</td>
                <td>{{ $patient->phone }}</td>
                <td>{{ $patient->dob }}</td>
                <td>{{ $patient->group_number }}</td>
                <td>{{ $patient->admission_date }}</td>
                <td>{{ $patient->approved ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('patients.edit', $patient->patient_id) }}" class="btn btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<style>
.patient-list {
    padding: 20px;
    text-align: left;
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

.btn-warning {
    background-color: #ffcc00;
    color: #212529; 
}

.btn-warning:hover {
    background-color: #e0a800;
    color: #ffffff;
    transform: scale(1.05);
    border-color: #000000;
}

.patient-list .btn:last-child {
    margin-right: 0;
}

.btn:hover {
    background-color: #4267b2;
    color: #ffffff;
    transform: scale(1.05);
    border-color: #365899;
}

</style>
    <div class="container patient-list">
        <h1>Patients</h1>

        @if($patients->isEmpty())
            <p>No patients found.</p>
        @else
            <table class="table patient-table">
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
                                <a href="{{ route('patients.edit', ['patient_id' => $patient->patient_id]) }}" class="btn btn-sharp btn-warning">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

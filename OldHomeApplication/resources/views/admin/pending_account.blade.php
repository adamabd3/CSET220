@extends('layouts.app')

@section('content')
<style>
.btn {
    font-family: 'Arial', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    padding: 12px 24px;
    border: 2px solid #4267b2; 
    background-color: #ffffff; 
    color: #4267b2; 
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    margin-bottom: 15px;
}

.btn-sharp {
    border-radius: 0;
}

.btn-sharp:hover {
    background-color: #4267b2; 
    color: #ffffff; 
    transform: scale(1.05);
    border-color: #365899; 
}

form:last-child .btn {
    margin-bottom: 0;
}

.pending-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 1rem;
    text-align: left;
}

.pending-table th, .pending-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
}

.pending-table th {
    background-color: #4267b2;
    color: #ffffff;
    text-transform: uppercase;
    font-weight: bold;
}

.pending-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.pending-table tr:hover {
    background-color: #e6efff;
}

.admin-pending-accounts form {
    margin-right: 5px;
    display: inline-block;
}

</style>
    <div class="container admin-pending-accounts">
        <h2>Pending Accounts</h2>

        <h3>Pending Patients</h3>
        @if($pendingPatients->isEmpty())
            <p>No pending patient accounts.</p>
        @else
            <table class="table pending-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingPatients as $patient)
                        <tr>
                            <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                            <td>{{ $patient->email }}</td>
                            <td>
                                <form action="{{ route('admin.approve', ['type' => 'patient', 'id' => $patient->patient_id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sharp btn-success">Approve</button>
                                </form>
                                <form action="{{ route('admin.deny', ['type' => 'patient', 'id' => $patient->patient_id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sharp btn-danger">Deny</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h3>Pending Employees</h3>
        @if($pendingEmployees->isEmpty())
            <p>No pending employee accounts.</p>
        @else
            <table class="table pending-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingEmployees as $employee)
                        <tr>
                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->role }}</td>
                            <td>
                                <form action="{{ route('admin.approve', ['type' => 'employee', 'id' => $employee->employee_id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sharp btn-success">Approve</button>
                                </form>
                                <form action="{{ route('admin.deny', ['type' => 'employee', 'id' => $employee->employee_id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sharp btn-danger">Deny</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

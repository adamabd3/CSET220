<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
</head>
<style>
    .search input, .search button{
        padding: 10 0 10 0;
        width: 300px;
    }
    .search form{
        flex-direction: column;
        display: flex;
        align-items: center;
    }
    .table{
        border-collapse: collapse;
        margin: 25px 0px;
        width: 780px;
        overflow: auto;
        max-height: 500px;
        margin-left: 200px;
        border: 5px solid blue;
    }
    td, th {
        padding: 12px 15px;
        border: solid 2px blue;
    }
    thead{
        background-color: blue;
    }

    tbody tr:hover{
        background-color: #ddd;
    }
    span{
        color: blue;
        padding: 10px;
    }
    .role{
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    button{
        color: black;
    }
</style>
@extends('layouts.app')

@section('title', 'name_of_page')

@section('content')
<body>
    
    <div class="role">
        <p>Role: <span>{{ auth()->user()->role }}</span></p><br>

    </div>
    <div class="search">
        <form method="GET" action="{{ url('employee_info') }}">
            <input type="text" name="Esearch" placeholder="Search by Employee ID" value="{{ request('Esearch') }}">
            <input type="text" name="Nsearch" placeholder="Search by Name" value="{{ request('Nsearch') }}">
            <input type="text" name="Ssearch" placeholder="Search by Salary" value="{{ request('Ssearch') }}">
            <input type="text" name="Rsearch" placeholder="Search by Role" value="{{ request('Rsearch') }}">
            <input type="text" name="Dsearch" placeholder="Search by DOB" value="{{ request('Dsearch') }}">
            <input type="text" name="EMsearch" placeholder="Search by Email" value="{{ request('EMsearch') }}">
            <input type="text" name="Psearch" placeholder="Search by Phone" value="{{ request('Psearch') }}">
            <button type="submit">Search</button>
            @if(auth()->user()->role == 'Admin')
            <form method="GET" action="{{ url('employee_info') }}">
                <button type="submit" name="edit_mode" value="{{ request('edit_mode') ? '0' : '1' }}">
                    {{ request('edit_mode') ? 'Disable Edit Mode' : 'Enable Edit Mode' }}
                </button>
            </form>
        @endif
        </form>
    </div>
    <div class="table">
        <form method="POST" action="{{ url('employee_info') }}">
            @csrf
            <table>
                <tr>
                    <thead>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Salary</th>
                        <th>Email</th>
                        <th>Phone #</th>
                        <th>Date of birth</th>
                    </thead>
                </tr>
                <tbody>
                    @foreach ($employee as $e)
                    <tr>
                        <td>
                            <input type="hidden" name="employee_id[]" value="{{ $e->employee_id }}">
                            {{ $e->employee_id }}
                        </td>                        
                        <td>
                            @if (request('edit_mode'))
                                <input type="text" name="first_name[]" value="{{ $e->first_name }}" >
                                <input type="text" name="last_name[]" value="{{ $e->last_name }}" >
                            @else
                                {{ $e->first_name }} {{ $e->last_name }}
                            @endif
                        </td>
                        <td>
                            @if (request('edit_mode'))
                                <input type="text" name="role[]" value="{{ $e->role }}" >
                            @else
                                {{ $e->role }}
                            @endif
                        </td>
                        <td>
                            @if (request('edit_mode'))
                                <input type="number" name="salary[]" value="{{ $e->salary }}" >
                            @else
                                ${{ $e->salary }}
                            @endif
                        </td>
                        <td>
                            @if (request('edit_mode'))
                                <input type="email" name="email[]" value="{{ $e->email }}" >
                            @else
                                {{ $e->email }}
                            @endif
                        </td>
                        <td>
                            @if (request('edit_mode'))
                                <input type="tel" name="phone[]" value="{{ $e->phone }}" >
                            @else
                                {{ $e->phone }}
                            @endif
                        </td>
                        <td>
                            @if (request('edit_mode'))
                                <input type="date" name="dob[]" value="{{ $e->dob }}" >
                            @else
                                {{ $e->dob }}
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if (request('edit_mode'))
                <button type="submit">Save Changes</button>
            @endif
        </form>
    </div>
</body>
@endsection
</html>
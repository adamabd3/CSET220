@extends('layouts.app')

@section('title', 'Supervisor Dashboard')

@section('content')
    <link rel="stylesheet" href="css/buttons.css">
    <div class="container">
        <h1>Supervisor Dashboard</h1>
        <form action="{{ route('admin.pending') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-sharp">Pending Accounts</button>
        </form><br>

        <form action="{{ route('supervisor.newAppointment') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-sharp">Schedule Appointment</button>
        </form><br>
    </div>
@endsection
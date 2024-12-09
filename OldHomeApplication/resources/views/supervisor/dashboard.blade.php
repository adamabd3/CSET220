@extends('layouts.app')

@section('title', 'Supervisor Dashboard')

@section('content')
    <div class="container">
        <h1>Supervisor Dashboard</h1>
        <form action="{{ route('admin.pending') }}" method="GET">
            @csrf
            <button type="submit">Pending Accounts</button>
        </form><br>

        <form action="{{ route('supervisor.newAppointment') }}" method="GET">
            @csrf
            <button type="submit">Schedule Appointment</button>
        </form><br>
    </div>
@endsection
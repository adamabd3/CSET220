<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Roster Info</title>
    </head>
    <style>
        .table{
        border-collapse: collapse;
        margin: 25px 0px;
        width: 70%;
        overflow: auto;
        max-height: 26%;
        margin-left: 200px;
        border: 5px solid blue;
        overflow: scroll;
        }
        td, th {
            padding: 12px 15px;
            border: solid 2px blue;
            height: fit-content;
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
        button{
            margin-top: 5px;
        }
        .roster-creationf{
            display: flex;
            flex-direction: column;
            align-items: right;
        }
        .roster-creationf input, .roster-creationf button{
            margin-top: 5px;
            height: 35px;
        }

        .all_tables{
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }

        .rosterCreate{
            margin-bottom: 13px;
        }
        .rosterCreate button{
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
        }
        .rosterCreate button:hover{
            cursor: pointer;
        }
    </style>
@extends('layouts.app')

@section('title', 'Roster info')

@section('content')

@if(auth()->user()->role == 'Admin')
     <form class="rosterCreate" method="POST" actionw="{{ url('daily_roster') }}">
         @csrf
         <h3>WELCOME <br><span>ADMIN</span></h3>
         <button type="submit" name="create_roster" value="{{ request('create_roster') ? '0' : '1' }}"><b>
             {{ request('create_roster') ? 'Back to Daily Roster' : 'Create Roster' }}</b>
         </button>
     </form>
@endif

@if(auth()->user()->role == 'Supervisor')
     <form class="rosterCreate" method="POST" actionw="{{ url('daily_roster') }}">
         @csrf
         <h3>WELCOME <br><span>Supervisor</span></h3>
         <button type="submit" name="create_roster" value="{{ request('create_roster') ? '0' : '1' }}"><b>
             {{ request('create_roster') ? 'Back to Daily Roster' : 'Create Roster' }}</b>
         </button>
     </form>
@endif

@if (request('create_roster'))
    <div class="roster-creation">
        <form method="POST" class="roster-creationf" action="{{ route('roster.create') }}">
            @csrf
            <h2><Span>Create Roster: </Span></h2>
            <input type="date" name="new_date" value= "<?php echo date('Y-m-d'); ?>">
            <input type="text" name="new_doctor" placeholder="DoctorID on duty">
            <input type="text" name="new_supervisor" placeholder="SupervisorID on duty">
            <input type="text" name="new_caregiver1" placeholder="CaregiverID on duty">
            <input type="text" name="new_caregiver2" placeholder="CaregiverID on duty">
            <input type="text" name="new_caregiver3" placeholder="CaregiverID on duty">
            <input type="text" name="new_caregiver4" placeholder="CaregiverID on duty">
            <button type="submit">Create</button>
        </form>
    </div>
    <br>
    <h4>RosterID Reference:</h4>
    <div class="all_tables">
        <table class="doctor_table">
            <tr>
                <th>Doctors</th>
                <th>ID</th>
            </tr>
            @foreach ($doctor as $d)
                <tr>
                <td>{{ $d->first_name }} {{ $d->last_name }}</td>
                <td>{{ $d->employee_id}}</td>
                </tr>
            @endforeach
        </table>


        <table class="Supervisor_table">
            <tr>
                <th>Supervisors</th>
                <th>ID</th>
            </tr>
            @foreach ($supervisor as $s)
                <tr>
                <td>{{ $s->first_name }} {{ $s->last_name }}</td>
                <td>{{ $s->employee_id}}</td>
                </tr>
            @endforeach
        </table>

        <table class="caregiver_table">
            <tr>
                <th>Caregivers</th>
                <th>ID</th>
            </tr>
            @foreach ($caregiver as $c)
                <tr>
                <td>{{ $c->first_name }} {{ $c->last_name }}</td>
                <td>{{ $c->employee_id}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@else

    @foreach ($roster as $r)
        <form method="GET" action="{{ url('daily_roster') }}">
            <p>Roster for <span>{{ $r->date }}</span></p>
            <br>
            <input type="date" name="date">
            <br>
            <button type="submit">Change date</button>
        </form>
    @endforeach
        <div class="table">
            <table>
                <tr>
                    <thead>
                        <th>Date</th>
                        <th>Available Doctor</th>
                        <th>Available Supervisor</th>
                        <th>Available Caregiver </th>
                        <th>Available Caregiver</th>
                        <th>Available Caregiver</th>
                        <th>Available Caregiver</th>
                    </thead>
                </tr>
                <tbody>
                    @foreach ($roster as $r)
                    <tr>
                        <td>{{$r->date}}</td>
                        <td>{{$r->doctor->first_name}} {{$r->doctor->last_name}}</td>
                        <td>{{$r->supervisor->first_name}} {{$r->supervisor->last_name}}</td>
                        <td>{{$r->caregiver1->first_name}} {{$r->caregiver1->last_name}}</td>
                        <td>{{$r->caregiver2->first_name}} {{$r->caregiver2->last_name}}</td>
                        <td>{{$r->caregiver3->first_name}} {{$r->caregiver3->last_name}}</td>
                        <td>{{$r->caregiver4->first_name}} {{$r->caregiver4->last_name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @endsection 
</html>
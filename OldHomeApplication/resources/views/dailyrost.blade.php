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
        width: 780px;
        overflow: auto;
        max-height: 300px;
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
        button{
            margin-top: 5px;
        }
    </style>
@extends('layouts.app')

@section('title', 'Roster info')

 @section('content')

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
                        <th>Available Caregiver </th>
                        <th>Available Caregiver</th>
                        <th>Available Caregiver</th>
                        <th>Available Caregiver</th>
                        <th>Available Supervisor</th>
                    </thead>
                </tr>
                <tbody>
                    @foreach ($roster as $r)
                    <tr>
                        <td>{{$r->date}}</td>
                        <td>{{$r->doctor->first_name}} {{$r->supervisor->last_name}}</td>
                        <td>{{$r->caregiver1->first_name}} {{$r->caregiver1->last_name}}</td>
                        <td>{{$r->caregiver2->first_name}} {{$r->caregiver2->last_name}}</td>
                        <td>{{$r->caregiver3->first_name}} {{$r->caregiver3->last_name}}</td>
                        <td>{{$r->caregiver4->first_name}} {{$r->caregiver4->last_name}}</td>
                        <td>{{$r->supervisor->first_name}} {{$r->supervisor->last_name}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endsection 
    </html>
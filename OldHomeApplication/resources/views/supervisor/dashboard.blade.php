@extends('layouts.app')

@section('title', 'Supervisor Dashboard')

@section('content')
    <div class="container">
        <h1>Supervisor Dashboard</h1>
        <form action="{{ route('admin.pending') }}" method="GET">
            @csrf
            <button type="submit">Pending Accounts</button>
        </form>
    </div>
@endsection
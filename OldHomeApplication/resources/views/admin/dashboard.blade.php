@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>
        <form action="{{ route('admin.pending') }}" method="GET">
            @csrf
            <button type="submit">Pending Accounts</button>
        </form>
        <form action="{{ route('patients.index') }}" method="GET">
            <button type="submit">Edit Patient Accounts</button>
        </form>
        <form action="{{ route('admin.showPaymentsPage') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-primary">Payments</button>
        </form>
    </div>
@endsection
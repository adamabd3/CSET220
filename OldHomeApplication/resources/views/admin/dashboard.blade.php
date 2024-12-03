@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>
        <form action="{{ route('admin.pending') }}" method="GET">
            @csrf
            <button type="submit">Pending Accounts</button>
        </form>
    </div>
@endsection
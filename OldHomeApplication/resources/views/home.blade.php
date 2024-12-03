@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>home</h1>
        <form action="{{ route('register') }}" method="GET">
            @csrf
            <button type="submit">Pending Accounts</button>
        </form>
        <form action="{{ route('login') }}" method="GET">
            @csrf
            <button type="submit">Pending Accounts</button>
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <h1>Home</h1>
        <form action="{{ route('login') }}" method="GET">
            @csrf
            <button type="submit">Login</button>
        </form>
        <form action="{{ route('register') }}" method="GET">
            @csrf
            <button type="submit">Register</button>
        </form>
        <form action="{{ route('family-login') }}" method="GET">
            <button type="submit">Family Log In</button>
        </form>
    </div>
@endsection
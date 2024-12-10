@extends('layouts.app')


@section('title', 'Home')

@section('content')
    <link rel="stylesheet" href="css/buttons.css">
    <div class="container centered-page">
        <h1>Home</h1>
        <form action="{{ route('login') }}" method="GET" class="form">
            @csrf
            <button type="submit" class="btn btn-sharp">Login</button>
        </form>
        <form action="{{ route('register') }}" method="GET" class="form">
            @csrf
            <button type="submit" class="btn btn-sharp">Register</button>
        </form>
        <form action="{{ route('family-login') }}" method="GET" class="form">
            <button type="submit" class="btn btn-sharp">Family Log In</button>
        </form>
    </div>
@endsection
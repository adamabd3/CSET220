@extends('layouts.app')

@section('title', 'Family Login')

@section('content')
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('family-login') }}" method="POST">
        @csrf
        <div>
            <label for="family_code">Family Code</label>
            <input type="text" name="family_code" id="family_code" required>
        </div>
        <div>
            <label for="patient_id">Patient ID</label>
            <input type="text" name="patient_id" id="patient_id" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
@endsection
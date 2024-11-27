@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="signup-form">
        <h2>Create an Account</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <label for="role">I am a:</label>
            <select name="role" id="role" onchange="togglePatientFields()">
                <option value="admin">Admin</option>
                <option value="supervisor">Supervisor</option>
                <option value="doctor">Doctor</option>
                <option value="caregiver">Caregiver</option>
                <option value="patient">Patient</option>
            </select>
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="phone" placeholder="Phone Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="date" name="dob" placeholder="Date of Birth" required>

            <div id="patient-fields" style="display: none;">
                <input type="text" name="family_code" placeholder="Family Code">
                <input type="text" name="emergency_contact" placeholder="Emergency Contact Name">
                <input type="text" name="relation_to_contact" placeholder="Relation to Contact">
            </div>

            <button type="submit">Sign Up</button>
        </form>
    </div>

    <script>
        function togglePatientFields() {
            const role = document.getElementById('role').value;
            const patientFields = document.getElementById('patient-fields');
            if (role === 'patient') {
                patientFields.style.display = 'block';
            } else {
                patientFields.style.display = 'none';
            }
        }
    </script>
@endsection

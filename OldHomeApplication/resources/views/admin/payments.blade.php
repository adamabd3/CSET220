@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Payments Management</h1>

    <!-- Form to trigger payment update -->
    <form action="{{ route('admin.updatePayments') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary mb-3">Update Payments</button>
    </form>

    <!-- Table to display patients and their payments -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Patient Name</th>
                <th>Admission Date</th>
                <th>Total Due</th>
                <th>Last Update</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($patients as $patient)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $patient->first_name }} {{ $patient->last_name }}</td>
                    <td>{{ $patient->admission_date ? \Carbon\Carbon::parse($patient->admission_date)->format('M d, Y') : 'Not Available' }}</td>
                    <td>
                        @if ($patient->payment)
                            ${{ number_format($patient->payment->total_due, 2) }}
                        @else
                            $0.00
                        @endif
                    </td>
                    <td>
                        @if ($patient->payment && $patient->payment->last_update)
                            {{ \Carbon\Carbon::parse($patient->payment->last_update)->format('M d, Y') }}
                        @else
                            Not Updated
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No patients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

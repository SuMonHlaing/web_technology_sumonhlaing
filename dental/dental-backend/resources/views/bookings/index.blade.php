@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Booking List</h1>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>User </th>
                    <th>Doctor </th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Preferred Date</th>
                    <th>Preferred Time</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($appointments as $booking)
                    <tr>
                        <td>{{ $booking->user->id }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->doctor->name }}</td>
                        <td>{{ $booking->full_name }}</td>
                        <td>{{ $booking->email }}</td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ $booking->preferred_date }}</td>
                        <td>{{ $booking->preferred_time }}</td>
                        <td>{{ $booking->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <h3 class="mb-3">Doctor Details</h3>

    <div class="card shadow-sm p-4">
        <p><strong>Name:</strong> {{ $doctor->name }}</p>
        <p><strong>Experience:</strong> {{ $doctor->experience }}</p>
        <p><strong>Image:</strong></p>
        @if ($doctor->image)
            <img src="{{ asset('storage/' . $doctor->image) }}" width="100" class="img-thumbnail">
        @endif
        <br><br>
        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection

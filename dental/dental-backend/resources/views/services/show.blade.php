@extends('layouts.app')

@section('content')
    <h3 class="mb-3">Service Details</h3>

    <div class="card shadow-sm p-4">
        <p><strong>Name:</strong> {{ $service->name }}</p>
        <p><strong>Description:</strong> {{ $service->description }}</p>
        <p><strong>Doctor:</strong> {{ $service->doctor->name ?? 'N/A' }}</p>
        <p><strong>Icon:</strong></p>
        @if ($service->icon)
            <img src="{{ asset('storage/' . $service->icon) }}" width="100" class="img-thumbnail">
        @endif
        <br><br>
        <a href="{{ route('services.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
@endsection

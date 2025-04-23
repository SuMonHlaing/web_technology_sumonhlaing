@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('services.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
    </div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="mb-3">
        <h3 class="mb-3">Update Service</h3>
        <p class="text-muted">Edit the details of the service below.</p>
    </div>
    <form action="{{ route('services.update', $service->id) }}" method="POST" enctype="multipart/form-data"
        class="card p-4 shadow-sm">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $service->name }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $service->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Doctors</label>
            <div class="form-check">
                @foreach ($doctors as $doctor)
                    <div class="mb-2">
                        <input type="checkbox" name="doctor_ids[]" value="{{ $doctor->id }}" class="form-check-input"
                            id="doctor_{{ $doctor->id }}"
                            {{ in_array($doctor->id, $service->doctors->pluck('id')->toArray()) ? 'checked' : '' }}>
                        <label for="doctor_{{ $doctor->id }}" class="form-check-label">{{ $doctor->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label>Icon</label>
            <input type="file" name="icon" class="form-control">
            @if ($service->icon)
                <img src="{{ asset('storage/' . $service->icon) }}" class="mt-2" width="60">
            @endif
        </div>

        <button class="btn btn-primary"><i class="fas fa-save"></i> Update Service</button>
    </form>
@endsection

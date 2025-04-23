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
        <h3 class="mb-3">Create New Service</h3>
        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter service name">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control" placeholder="Service details..."></textarea>
            </div>

          

            <div class="mb-3">
                <label>Doctors</label>
                <div class="form-check">
                    @foreach ($doctors as $doctor)
                        <div class="mb-2">
                            <input type="checkbox" name="doctor_ids[]" value="{{ $doctor->id }}" class="form-check-input"
                                id="doctor_{{ $doctor->id }}">
                            <label for="doctor_{{ $doctor->id }}" class="form-check-label">{{ $doctor->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label>Icon (image)</label>
                <input type="file" name="icon" class="form-control">
            </div>

            <button class="btn btn-success"><i class="fas fa-save"></i> Save Service</button>
        </form>
    @endsection

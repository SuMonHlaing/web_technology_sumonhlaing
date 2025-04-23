@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Edit Doctor</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data"
        class="card p-4 shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $doctor->name) }}">
        </div>

        <div class="mb-3">
            <label>Experience</label>
            <input type="text" name="experience" class="form-control"
                value="{{ old('experience', $doctor->experience) }}">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if ($doctor->image)
                <img src="{{ asset('storage/' . $doctor->image) }}" width="100" class="mt-2 img-thumbnail">
            @endif
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}">
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $doctor->location) }}">
        </div>

        <div class="mb-3">
            <label>Working Hours</label>
            <input type="text" name="working_hours" class="form-control"
                value="{{ old('working_hours', $doctor->working_hours) }}">
        </div>

        <div class="mb-3">
            <label>Certifications</label>
            <textarea name="certifications" class="form-control" rows="3">{{ old('certifications', $doctor->certifications) }}</textarea>
        </div>

        <div class="mb-3">
            <label>About</label>
            <textarea name="about" class="form-control" rows="4">{{ old('about', $doctor->about) }}</textarea>
        </div>

        <button class="btn btn-primary"><i class="fas fa-save"></i> Update Doctor</button>
    </form>
@endsection

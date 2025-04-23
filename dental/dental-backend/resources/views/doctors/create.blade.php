@extends('layouts.app')

@section('content')
    <div class="mb-3">
        <a href="{{ route('doctors.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
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
        <h3 class="mb-3">Create New Doctor</h3>
        <p class="text-muted">Fill in the details of the new doctor below.</p>
    </div>
    <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter doctor's name">
        </div>

        <div class="mb-3">
            <label>Experience</label>
            <input type="text" name="experience" class="form-control" placeholder="Enter experience details">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Enter email address">
        </div>

        <div class="mb-3">
            <label>Location</label>
            <input type="text" name="location" class="form-control" placeholder="Enter clinic location">
        </div>

        <div class="mb-3">
            <label>Working Hours</label>
            <input type="text" name="working_hours" class="form-control" placeholder="e.g., Mon–Fri, 9am–5pm">
        </div>

        <div class="mb-3">
            <label>Certifications</label>
            <textarea name="certifications" class="form-control" placeholder="List certifications"></textarea>
        </div>

        <div class="mb-3">
            <label>About</label>
            <textarea name="about" class="form-control" placeholder="Write something about the doctor"></textarea>
        </div>

        <button class="btn btn-success"><i class="fas fa-save"></i> Save Doctor</button>
    </form>
@endsection

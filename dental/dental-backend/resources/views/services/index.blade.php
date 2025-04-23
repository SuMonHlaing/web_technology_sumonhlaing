@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
        <h3>All Services</h3>
        <a href="{{ route('services.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Service
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Doctors</th>
                        <th>Icon</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->description }}</td>
                            <td>
                                @if ($service->doctors->isNotEmpty())
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($service->doctors as $doctor)
                                            <li>{{ $doctor->name }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span>N/A</span>
                                @endif
                            </td>
                            <td>
                                @if ($service->icon)
                                    <img src="{{ asset('storage/' . $service->icon) }}" width="40"
                                        class="img-thumbnail">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('services.show', $service->id) }}"
                                    class="btn btn-sm btn-info text-white"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('services.edit', $service->id) }}"
                                    class="btn btn-sm btn-warning text-white"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('services.destroy', $service->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
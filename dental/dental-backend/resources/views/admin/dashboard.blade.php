@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Admin Dashboard</h2>
</div>

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th style="width: 5%;">no</th>
                    <th>Module</th>
                    <th>Description</th>
                    <th style="width: 20%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach([
                    ['Doctors', 'Manage doctor list and profiles', 'doctors'],
                    ['Services', 'Manage offered medical services', 'services'],
                    ['Bookings', 'Handle appointments and reservations', 'bookings'],
                    ['Users', 'Manage registered users', 'users']
                ] as $index => $module)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $module[0] }}</td>
                        <td>{{ $module[1] }}</td>
                        <td>
                            <!-- View button -->
                            <a href="{{ route($module[2] . '.index') }}" class="btn btn-sm btn-primary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Role & Permission Management</h2>
        <a href="{{ route('permissions.index') }}" class="btn btn-primary">
            <i class="bi bi-shield-lock-fill"></i> Manage Permissions
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Role dan Permissions</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Role</th>
                        <th>Permissions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role => $permissions)
                        <tr>
                            <td class="fw-semibold">{{ $role }}</td>
                            <td>
                                @foreach ($permissions as $perm)
                                    <span class="badge bg-secondary me-1">{{ $perm }}</span>
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted">Belum ada role terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

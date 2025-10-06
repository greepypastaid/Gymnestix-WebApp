@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4 text-center">Admin Dashboard</h2>
    <div class="row justify-content-center">
        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 border-0">
                <div class="card-body text-center">
                    <span class="mb-2" style="font-size:2.5rem;color:#0d6efd;"><i class="bi bi-people-fill"></i></span>
                    <h5 class="card-title mt-2">User & Member</h5>
                    <a href="{{ route('admin.index') }}" class="btn btn-outline-primary w-100 mt-2">Kelola User</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 border-0">
                <div class="card-body text-center">
                    <span class="mb-2" style="font-size:2.5rem;color:#198754;"><i class="bi bi-card-checklist"></i></span>
                    <h5 class="card-title mt-2">Membership Plan</h5>
                    <a href="{{ route('membership_plan.index') }}" class="btn btn-outline-success w-100 mt-2">Kelola Plan</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 border-0">
                <div class="card-body text-center">
                    <span class="mb-2" style="font-size:2.5rem;color:#fd7e14;"><i class="bi bi-calendar-event"></i></span>
                    <h5 class="card-title mt-2">Jadwal Kelas/Gym</h5>
                    <a href="{{ route('gym_class.index') }}" class="btn btn-outline-warning w-100 mt-2">Kelola Jadwal</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 border-0">
                <div class="card-body text-center">
                    <span class="mb-2" style="font-size:2.5rem;color:#dc3545;"><i class="bi bi-credit-card"></i></span>
                    <h5 class="card-title mt-2">Pembayaran</h5>
                    <a href="{{ route('billing.index') }}" class="btn btn-outline-danger w-100 mt-2">Kelola Pembayaran</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection

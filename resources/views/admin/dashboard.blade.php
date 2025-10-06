@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
    <h2 class="fw-bold mb-4 text-center">Admin Dashboard</h2>

    <div class="row justify-content-center mb-4">
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

    <div class="tools-grid">
        @can('schedule.assign_trainer')
        <div class="tool-card">
            <div class="tool-ico acc-orange"><i class="bi bi-calendar2-check"></i></div>
            <div class="tool-title">Jadwal & Assign Trainer</div>
            <div class="tool-desc">Kelola jadwal kelas dan penugasan pelatih.</div>
            <div class="mt-3">
                <a href="{{ Route::has('admin.assignments.index') ? route('admin.assignments.index') : '#' }}"
                   class="btn btn-outline-warning btn-sm btn-outline">
                  Kelola Jadwal
                </a>
            </div>
        </div>
        @endcan

        @can('attendance.track')
        <div class="tool-card">
            <div class="tool-ico acc-green"><i class="bi bi-clipboard-check"></i></div>
            <div class="tool-title">Attendance</div>
            <div class="tool-desc">Catat & pantau kehadiran member.</div>
            <div class="mt-3">
                <a href="{{ Route::has('admin.attendance.index') ? route('admin.attendance.index') : '#' }}"
                   class="btn btn-outline-success btn-sm btn-outline">
                  Kelola Attendance
                </a>
            </div>
        </div>
        @endcan

        @canany(['equipment.manage','equipment.view_all'])
        <div class="tool-card">
            <div class="tool-ico acc-slate"><i class="bi bi-cpu"></i></div>
            <div class="tool-title">Equipment</div>
            <div class="tool-desc">
                @can('equipment.manage') Kelola data & status alat gym. @else Lihat seluruh alat gym. @endcan
            </div>
            <div class="mt-3">
                <a href="{{ Route::has('admin.equipment.index') ? route('admin.equipment.index') : '#' }}"
                   class="btn btn-outline-info btn-sm btn-outline">
                  Buka Equipment
                </a>
            </div>
        </div>
        @endcanany

        @can('workout.manage')
        <div class="tool-card">
            <div class="tool-ico acc-violet"><i class="bi bi-activity"></i></div>
            <div class="tool-title">Workout Manager</div>
            <div class="tool-desc">Template latihan & progress tracking.</div>
            <div class="mt-3">
                <a href="{{ Route::has('admin.workout.index') ? route('admin.workout.index') : '#' }}"
                   class="btn btn-outline-secondary btn-sm btn-outline">
                  Kelola Workout
                </a>
            </div>
        </div>
        @endcan
    </div>
</div>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
  .tools-grid{display:grid;gap:1rem}
  @media (min-width:768px){.tools-grid{grid-template-columns:repeat(2,1fr)}}
  @media (min-width:992px){.tools-grid{grid-template-columns:repeat(4,1fr)}}

  .tool-card{
    border:1px solid rgba(0,0,0,.08); background:#fff; border-radius:1rem;
    padding:1.25rem; box-shadow:0 6px 18px rgba(0,0,0,.05); transition:.15s ease;
  }
  .tool-card:hover{transform:translateY(-2px); box-shadow:0 10px 22px rgba(0,0,0,.08)}
  .tool-ico{
    width:56px; height:56px; border-radius:16px;
    display:inline-flex; align-items:center; justify-content:center; font-size:28px;
  }
  .btn-outline{background:#fff}
  .tool-title{font-weight:600; margin:10px 0 4px}
  .tool-desc{color:#6c757d; font-size:.9rem}
  /* accent helpers */
  .acc-blue{color:#0d6efd; background:#e8f0ff}
  .acc-green{color:#198754; background:#e9f7ef}
  .acc-orange{color:#fd7e14; background:#fff2e6}
  .acc-violet{color:#6f42c1; background:#f1e9ff}
  .acc-slate{color:#0aa; background:#e8fbfb}
</style>
@endsection

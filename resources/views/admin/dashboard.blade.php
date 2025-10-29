@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
    <h2 class="fw-bold mb-4 text-center text-white">Admin Dashboard</h2>  <!-- Tambah text-white -->

    <div class="row justify-content-center mb-4">
        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 bg-neutral-800 text-white">  <!-- Ubah bg-white ke bg-neutral-800, tambah text-white -->
                <div class="card-body text-center">
                    <span class="mb-2" style="font-size:2.5rem;color:#ADFF2F;"><i class="bi bi-people-fill"></i></span>  <!-- Ubah warna ikon ke #ADFF2F -->
                    <h5 class="card-title mt-2 text-white">User & Member</h5>  <!-- Tambah text-white -->
                    <a href="{{ route('admin.index') }}" class="btn btn-outline-success w-100 mt-2" style="border-color:#ADFF2F; color:#ADFF2F;">Kelola User</a>  <!-- Ubah ke aksen hijau -->
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 bg-neutral-800 text-white">
                <div class="card-body text-center">
                    <span class="mb-2" style="font-size:2.5rem;color:#ADFF2F;"><i class="bi bi-card-checklist"></i></span>
                    <h5 class="card-title mt-2 text-white">Membership Plan</h5>
                    <a href="{{ route('membership_plan.index') }}" class="btn btn-outline-success w-100 mt-2" style="border-color:#ADFF2F; color:#ADFF2F;">Kelola Plan</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 bg-neutral-800 text-white">
                <div class="card-body text-center">
                    <span class="mb-2" style="font-size:2.5rem;color:#ADFF2F;"><i class="bi bi-calendar-event"></i></span>
                    <h5 class="card-title mt-2 text-white">Jadwal Kelas/Gym</h5>
                    <a href="{{ route('gym_class.index') }}" class="btn btn-outline-success w-100 mt-2" style="border-color:#ADFF2F; color:#ADFF2F;">Kelola Jadwal</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 bg-neutral-800 text-white">
                <div class="card-body text-center">
                    <span class="mb-2" style="font-size:2.5rem;color:#ADFF2F;"><i class="bi bi-credit-card"></i></span>
                    <h5 class="card-title mt-2 text-white">Pembayaran</h5>
                    <a href="{{ route('billing.index') }}" class="btn btn-outline-success w-100 mt-2" style="border-color:#ADFF2F; color:#ADFF2F;">Kelola Pembayaran</a>
                </div>
            </div>
        </div>
    </div>

    <div class="tools-grid">
        @can('schedule.assign_trainer')
        <div class="tool-card bg-neutral-800 text-white border-neutral-700">  <!-- Ubah bg, text, border -->
            <div class="tool-ico" style="color:#ADFF2F; background:#ADFF2F/10;"><i class="bi bi-calendar2-check"></i></div>  <!-- Aksen hijau -->
            <div class="tool-title text-white">Jadwal & Assign Trainer</div>  <!-- Tambah text-white -->
            <div class="tool-desc text-neutral-400">Kelola jadwal kelas dan penugasan pelatih.</div>  <!-- Ubah ke text-neutral-400 -->
            <div class="mt-3">
                <a href="{{ Route::has('admin.assignments.index') ? route('admin.assignments.index') : '#' }}"
                   class="btn btn-outline-warning btn-sm btn-outline" style="border-color:#ADFF2F; color:#ADFF2F;">Kelola Jadwal</a>  <!-- Aksen hijau -->
            </div>
        </div>
        @endcan

        @can('attendance.track')
        <div class="tool-card bg-neutral-800 text-white border-neutral-700">
            <div class="tool-ico" style="color:#ADFF2F; background:#ADFF2F/10;"><i class="bi bi-clipboard-check"></i></div>
            <div class="tool-title text-white">Attendance</div>
            <div class="tool-desc text-neutral-400">Catat & pantau kehadiran member.</div>
            <div class="mt-3">
                <a href="{{ Route::has('admin.attendance.index') ? route('admin.attendance.index') : '#' }}"
                   class="btn btn-outline-warning btn-sm btn-outline" style="border-color:#ADFF2F; color:#ADFF2F;">Kelola Attendance</a>
            </div>
        </div>
        @endcan

        @canany(['equipment.manage','equipment.view_all'])
        <div class="tool-card bg-neutral-800 text-white border-neutral-700">
            <div class="tool-ico" style="color:#ADFF2F; background:#ADFF2F/10;"><i class="bi bi-cpu"></i></div>
            <div class="tool-title text-white">Equipment</div>
            <div class="tool-desc text-neutral-400">
                @can('equipment.manage') Kelola data & status alat gym. @else Lihat seluruh alat gym. @endcan
            </div>
            <div class="mt-3">
                <a href="{{ Route::has('admin.equipment.index') ? route('admin.equipment.index') : '#' }}"
                   class="btn btn-outline-warning btn-sm btn-outline" style="border-color:#ADFF2F; color:#ADFF2F;">Buka Equipment</a>
            </div>
        </div>
        @endcanany

        @can('workout.manage')
        <div class="tool-card bg-neutral-800 text-white border-neutral-700">
            <div class="tool-ico" style="color:#ADFF2F; background:#ADFF2F/10;"><i class="bi bi-activity"></i></div>
            <div class="tool-title text-white">Workout Manager</div>
            <div class="tool-desc text-neutral-400">Template latihan & progress tracking.</div>
            <div class="mt-3">
                <a href="{{ Route::has('admin.workout.index') ? route('admin.workout.index') : '#' }}"
                   class="btn btn-outline-warning btn-sm btn-outline" style="border-color:#ADFF2F; color:#ADFF2F;">Kelola Workout</a>
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
    border:1px solid rgba(0,0,0,.08); background:#1f2937;  /* Ubah ke bg-neutral-800 */
    padding:1.25rem; box-shadow:0 6px 18px rgba(0,0,0,.05); transition:.15s ease;
  }
  .tool-card:hover{transform:translateY(-2px); box-shadow:0 10px 22px rgba(0,0,0,.08)}
  .tool-ico{
    width:56px; height:56px; border-radius:16px;
    display:inline-flex; align-items:center; justify-content:center; font-size:28px;
    color:#ADFF2F; background:#ADFF2F/10;  /* Aksen hijau */
  }
  .tool-title{font-weight:600; margin:10px 0 4px; color:#fff}  /* text-white */
  .tool-desc{color:#a3a3a3; font-size:.9rem}  /* text-neutral-400 */
  /* accent helpers */
  .acc-blue{color:#ADFF2F; background:#ADFF2F/10}  /* Ubah ke hijau */
  .acc-green{color:#ADFF2F; background:#ADFF2F/10}
  .acc-orange{color:#ADFF2F; background:#ADFF2F/10}
  .acc-violet{color:#ADFF2F; background:#ADFF2F/10}
  .acc-slate{color:#ADFF2F; background:#ADFF2F/10}
</style>
@endsection

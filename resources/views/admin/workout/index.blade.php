@extends('layouts.app')

@section('content')
<style>
  .control-card{border:1px solid rgba(0,0,0,.08); border-radius:.75rem; padding:.75rem .9rem; background:#fff}
  .control-card .label{font-size:.8rem; color:#6c757d; margin-bottom:.35rem; font-weight:600; letter-spacing:.2px}
  .soft-card{border:1px solid rgba(0,0,0,.08); border-radius:.9rem; background:#fff}
  .icon-pill{width:42px;height:42px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center}
</style>

<div class="container py-4">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div class="d-flex align-items-center gap-3">
      <div class="icon-pill bg-primary-subtle text-primary"><i class="bi bi-activity"></i></div>
      <div>
        <h5 class="mb-0 fw-semibold">Workout Progress</h5>
        <div class="text-muted small">Kelola progres latihan member</div>
      </div>
    </div>
    @can('workout.manage')
    <a href="{{ route('admin.workouts.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> Tambah Progress
    </a>
    @endcan
  </div>

  @if(session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif

  <div class="soft-card mb-3">
    <div class="p-3 border-bottom small fw-semibold text-muted">
      <i class="bi bi-funnel me-1"></i> Filter
    </div>
    <div class="p-3">
      <form method="GET" action="{{ route('admin.workouts.index') }}" class="row g-3 align-items-end">
        <div class="col-12 col-md-6">
          <div class="control-card h-100">
            <div class="label">Cari</div>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-search"></i></span>
              <input type="text" name="q" class="form-control" value="{{ $q ?? '' }}" placeholder="Nama/email member atau jenis latihan">
            </div>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="control-card h-100">
            <div class="label">Dari</div>
            <input type="date" name="from" class="form-control" value="{{ $from ?? '' }}">
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="control-card h-100">
            <div class="label">Sampai</div>
            <input type="date" name="to" class="form-control" value="{{ $to ?? '' }}">
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="soft-card">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr class="text-muted small">
            <th class="ps-4">Tanggal</th>
            <th>Member</th>
            <th>Jenis Latihan</th>
            <th class="text-center">Repetisi</th>
            <th class="text-center">Durasi (m)</th>
            <th class="text-center">Berat (kg)</th>
            <th class="text-end pe-4">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($rows as $r)
          <tr>
            <td class="ps-4 fw-semibold">{{ optional($r->tanggal)->format('d M Y') ?: '—' }}</td>
            <td>
              @php
                $memberName = $r->member?->user?->nama ?? $r->member?->nama ?? '—';
                $memberEmail = $r->member?->user?->email ?? '';
              @endphp
              <div class="fw-semibold">{{ $memberName }}</div>
              <div class="text-muted small">{{ $memberEmail }}</div>
            </td>
            <td>{{ $r->jenis_latihan ?? '—' }}</td>
            <td class="text-center">{{ $r->catatan_repetisi ?? 0 }}</td>
            <td class="text-center">{{ $r->catatan_durasi ?? 0 }}</td>
            <td class="text-center">{{ $r->catatan_berat ?? 0 }}</td>
            <td class="text-end pe-4">
              @can('workout.manage')
              <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.workouts.edit', $r->progress_id) }}">
                <i class="bi bi-pencil-square"></i>
              </a>
              <form action="{{ route('admin.workouts.destroy', $r->progress_id) }}" method="post" class="d-inline"
                    onsubmit="return confirm('Hapus record ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
              </form>
              @else
                <span class="text-muted small">No action</span>
              @endcan
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-5">
              <div class="py-2">
                <div class="mb-2"><i class="bi bi-journal-x" style="font-size:32px"></i></div>
                <div class="fw-semibold mb-1">Belum ada data</div>
                <div class="text-muted small mb-3">Tambah progres latihan pertama</div>
                @can('workout.manage')
                <a href="{{ route('admin.workouts.create') }}" class="btn btn-sm btn-primary">
                  <i class="bi bi-plus-lg me-1"></i> Tambah Progress
                </a>
                @endcan
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($rows->hasPages())
      <div class="p-3 d-flex justify-content-end">
        {{ $rows->links() }}
      </div>
    @endif
  </div>
</div>
@endsection

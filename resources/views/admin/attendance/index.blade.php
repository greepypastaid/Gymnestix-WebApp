@extends('layouts.app')

@section('content')
<style>
  /* util kecil biar “boxed” rapi */
  .control-card{border:1px solid rgba(0,0,0,.08); border-radius:.75rem; padding:.75rem .9rem; background:#fff}
  .control-card .label{font-size:.8rem; color:#6c757d; margin-bottom:.35rem; font-weight:600; letter-spacing:.2px}
  .soft-card{border:1px solid rgba(0,0,0,.08); border-radius:.9rem; background:#fff}
  .icon-pill{width:42px;height:42px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center}
  .header-card{border:1px solid rgba(0,0,0,.08); border-radius:.9rem; background:#fff}
</style>

<div class="container py-4">

  {{-- Header boxed --}}
<div class="header-card p-3 mb-3">
  <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
    <div class="d-flex align-items-center gap-3">
      <div class="icon-pill bg-primary-subtle text-primary">
        <i class="bi bi-clipboard-check"></i>
      </div>
      <div>
        <div class="h5 mb-0 fw-semibold">Attendance</div>
        <div class="text-muted small">Track member attendance &amp; manage records</div>
      </div>
    </div>

    <a href="{{ route('admin.attendance.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> Record Attendance
    </a>
  </div>
</div>

  @if(session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif

  {{-- Filter Boxed --}}
  <div class="soft-card mb-3">
    <div class="p-3 border-bottom small fw-semibold text-muted">
      <i class="bi bi-funnel me-1"></i> Filter
    </div>
    <div class="p-3">
      <form class="row g-3 align-items-end">
        <div class="col-12 col-md-3">
          <div class="control-card h-100">
            <div class="label">Date</div>
            <input type="date" name="date" class="form-control" value="{{ $date }}">
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="control-card h-100">
            <div class="label">Status</div>
            <select name="status" class="form-select">
              <option value="">All Status</option>
              @foreach(['present','absent','late'] as $st)
                <option value="{{ $st }}" @selected($status===$st)>{{ ucfirst($st) }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="control-card h-100">
            <div class="label">Search</div>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-search"></i></span>
              <input type="text" name="q" class="form-control" placeholder="Member name / email" value="{{ $q }}">
            </div>
          </div>
        </div>
        <div class="col-12 col-md-2">
          <div class="control-card h-100 d-grid">
            <div class="label"> </div>
            <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Filter</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  {{-- Table Boxed --}}
  <div class="soft-card">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr class="text-muted small">
            <th class="ps-4">Date</th>
            <th>Member</th>
            <th>Class</th>
            <th>Status</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th class="text-end pe-4">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse($attendances as $a)
            <tr>
              <td class="ps-4 fw-semibold">{{ $a->attendance_date->format('d M Y') }}</td>
              <td>
                <div class="fw-semibold">{{ $a->user->nama }}</div>
                <div class="text-muted small">{{ $a->user->email }}</div>
              </td>
              <td>
                @if($a->schedule)
                  <div class="fw-semibold">{{ $a->schedule->class_name }}</div>
                  <div class="text-muted small">
                    {{ $a->schedule->class_date->format('d M') }},
                    {{ \Illuminate\Support\Carbon::parse($a->schedule->start_time)->format('H:i') }}–{{ \Illuminate\Support\Carbon::parse($a->schedule->end_time)->format('H:i') }}
                  </div>
                @else
                  <span class="text-muted">—</span>
                @endif
              </td>
              <td>
                <span class="badge rounded-pill 
                  {{ $a->status === 'present' ? 'text-bg-success' : ($a->status === 'late' ? 'text-bg-warning' : 'text-bg-secondary') }}">
                  {{ ucfirst($a->status) }}
                </span>
              </td>
              <td>{{ $a->check_in_at?->format('H:i') ?? '—' }}</td>
              <td>{{ $a->check_out_at?->format('H:i') ?? '—' }}</td>
              <td class="text-end pe-4">
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.attendance.edit', $a) }}">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="{{ route('admin.attendance.destroy', $a) }}" method="post" class="d-inline"
                      onsubmit="return confirm('Delete this record?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash3"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-5">
                <div class="py-2">
                  <div class="mb-2"><i class="bi bi-journal-x" style="font-size:32px"></i></div>
                  <div class="fw-semibold mb-1">No attendance records</div>
                  <div class="text-muted small mb-3">Create your first record to get started</div>
                  <a href="{{ route('admin.attendance.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Record Attendance
                  </a>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($attendances->hasPages())
      <div class="p-3 d-flex justify-content-end">
        {{ $attendances->links() }}
      </div>
    @endif
  </div>

</div>
@endsection

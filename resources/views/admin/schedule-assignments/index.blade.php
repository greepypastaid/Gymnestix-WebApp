@extends('layouts.app')

@section('content')
<div class="container">
  <div class="max-7xl d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Assign Trainer — Schedules</h5>
    <a href="{{ route('admin.assignments.create') }}" class="btn btn-primary">Create Schedule</a>
  </div>

  <form class="mb-3" method="get">
    <div class="input-group">
      <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search class or room...">
      <button class="btn btn-outline-secondary">Search</button>
    </div>
  </form>

  <div class="card">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table mb-0 align-middle">
          <thead class="table-light">
            <tr>
              <th>Class</th><th>Date</th><th>Time</th><th>Room</th><th>Trainer</th><th></th>
            </tr>
          </thead>
          <tbody>
            @forelse($schedules as $s)
              <tr>
                <td class="fw-semibold">{{ $s->class_name }}</td>
                <td>{{ $s->class_date->format('d M Y') }}</td>
                <td>{{ $s->start_time->format('H:i') }}–{{ $s->end_time->format('H:i') }}</td>
                <td>{{ $s->room ?? '-' }}</td>
                <td>{{ optional($s->assignments->first()?->trainer)->nama ?? '— not assigned —' }}</td>
                <td class="text-end">
                  <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.assignments.edit', $s) }}">Assign / Edit</a>
                  <form action="{{ route('admin.assignments.destroy', $s) }}" method="post" class="d-inline" onsubmit="return confirm('Delete schedule?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="6" class="text-center py-4 text-muted">No schedules.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="mt-3">{{ $schedules->links() }}</div>
</div>
@endsection

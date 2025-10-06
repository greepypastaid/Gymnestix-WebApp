@extends('layouts.app')

@section('content')
<div class="container">
  <h5 class="mb-3">Edit Schedule & Assign Trainer</h5>

  @if(session('ok'))<div class="alert alert-success">{{ session('ok') }}</div>@endif
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <div class="card mb-3">
    <div class="card-body">
      <form method="post" action="{{ route('admin.assignments.update', $schedule) }}">
        @csrf @method('PUT')
        @include('admin.schedule-assignments._form', ['schedule' => $schedule])

        <hr class="my-4">

        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="form-label">Trainer</label>
            <select name="trainer_id" class="form-select">
              <option value="">— Not Assigned —</option>
              @foreach($trainers as $t)
                <option value="{{ $t->user_id }}" @selected(optional($assignment)->trainer_id == $t->user_id)>{{ $t->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Notes</label>
            <input name="notes" class="form-control" value="{{ old('notes', $assignment->notes ?? '') }}">
          </div>
        </div>

        <div class="d-flex gap-2">
          <button class="btn btn-primary">Save Changes</button>
          <a href="{{ route('admin.assignments.index') }}" class="btn btn-light">Back</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

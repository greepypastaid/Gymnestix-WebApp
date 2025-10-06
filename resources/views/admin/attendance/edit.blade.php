@extends('layouts.app')

@section('content')
<div class="container">
  <h5 class="mb-3">Edit Attendance</h5>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      <form method="post" action="{{ route('admin.attendance.update', $attendance) }}">
        @csrf @method('PUT')
        @include('admin.attendance._form', ['attendance' => $attendance])
        <div class="d-flex gap-2">
          <button class="btn btn-primary">Update</button>
          <a href="{{ route('admin.attendance.index') }}" class="btn btn-light">Back</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

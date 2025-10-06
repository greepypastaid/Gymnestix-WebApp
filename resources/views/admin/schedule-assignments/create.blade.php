@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
  <h5 class="mb-3">Create Schedule</h5>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      <form method="post" action="{{ route('admin.assignments.store') }}">
        @include('admin.schedule-assignments._form')
        <div class="d-flex gap-2">
          <button class="btn btn-primary">Save</button>
          <a href="{{ route('admin.assignments.index') }}" class="btn btn-light">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

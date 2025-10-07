@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h5 class="fw-semibold mb-3">Edit Workout Progress</h5>
  @if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
  @endif
  <form action="{{ route('admin.workouts.update', $row->progress_id) }}" method="post" class="soft-card p-3">
    @csrf @method('PUT')
    @include('admin.workout._form', ['row'=>$row,'members'=>$members])
  </form>
</div>
@endsection

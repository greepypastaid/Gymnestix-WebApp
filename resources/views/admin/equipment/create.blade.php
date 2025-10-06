@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h5 class="fw-semibold mb-3">Tambah Alat</h5>
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <form action="{{ route('admin.equipment.store') }}" method="post" class="soft-card p-3">
    @csrf
    @include('admin.equipment._form', ['row'=>$row])
  </form>
</div>
@endsection

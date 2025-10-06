@extends('layouts.app')

@section('content')
<style>
  .soft-card{border:1px solid rgba(0,0,0,.08); border-radius:.9rem; background:#fff}
</style>

<div class="container py-4">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h5 class="fw-semibold mb-0">Edit Alat</h5>
    <a href="{{ route('admin.equipment.index') }}" class="btn btn-light">← Kembali</a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <form action="{{ route('admin.equipment.update', $row->equipment_id) }}" method="post" class="soft-card p-3">
    @csrf @method('PUT')
    @include('admin.equipment._form', ['row'=>$row])
  </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
    <h2 class="fw-bold mb-4">Edit Membership Plan</h2>
    <form action="{{ route('membership_plan.update', $plan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_plan" class="form-label">Nama Plan</label>
            <input type="text" name="nama_plan" id="nama_plan" class="form-control" value="{{ $plan->nama_plan }}" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" value="{{ $plan->harga }}" required>
        </div>
        <div class="mb-3">
            <label for="periode_bulan" class="form-label">Durasi (bulan)</label>
            <input type="number" name="periode_bulan" id="periode_bulan" class="form-control" value="{{ $plan->periode_bulan }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $plan->deskripsi }}</textarea>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('membership_plan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

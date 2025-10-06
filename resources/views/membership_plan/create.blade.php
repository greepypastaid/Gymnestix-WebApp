@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Tambah Membership Plan</h2>
    <form action="{{ route('membership_plan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_plan" class="form-label">Nama Plan</label>
            <input type="text" name="nama_plan" id="nama_plan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="periode_bulan" class="form-label">Durasi (bulan)</label>
            <input type="number" name="periode_bulan" id="periode_bulan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('membership_plan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Tambah Jadwal Kelas/Gym</h2>
    <form action="{{ route('gym_class.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="trainer_id" class="form-label">Trainer ID</label>
            <input type="number" name="trainer_id" id="trainer_id" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
            <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
            <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="durasi" class="form-label">Durasi (menit)</label>
            <input type="number" name="durasi" id="durasi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="number" name="kapasitas" id="kapasitas" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Jadwal</button>
        <a href="{{ route('gym_class.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

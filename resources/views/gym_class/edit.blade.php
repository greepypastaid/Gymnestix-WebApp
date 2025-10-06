@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
    <h2 class="fw-bold mb-4">Edit Jadwal Kelas/Gym</h2>
    <form action="{{ route('gym_class.update', $gymClass->class_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" value="{{ $gymClass->nama_kelas }}" required>
        </div>
        <div class="mb-3">
            <label for="trainer_id" class="form-label">Trainer ID</label>
            <input type="number" name="trainer_id" id="trainer_id" class="form-control" value="{{ $gymClass->trainer_id }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ $gymClass->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
            <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" value="{{ $gymClass->waktu_mulai ? \Carbon\Carbon::parse($gymClass->waktu_mulai)->format('H:i') : '' }}" required>
        </div>
        <div class="mb-3">
            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
            <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" value="{{ $gymClass->waktu_selesai ? \Carbon\Carbon::parse($gymClass->waktu_selesai)->format('H:i') : '' }}" required>
        </div>
        <div class="mb-3">
            <label for="durasi" class="form-label">Durasi (menit)</label>
            <input type="number" name="durasi" id="durasi" class="form-control" value="{{ $gymClass->durasi }}" required>
        </div>
        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="number" name="kapasitas" id="kapasitas" class="form-control" value="{{ $gymClass->kapasitas }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update Jadwal</button>
        <a href="{{ route('gym_class.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

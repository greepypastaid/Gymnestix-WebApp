@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
    <h2 class="fw-bold mb-4">Detail Jadwal Kelas/Gym</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $gymClass->nama_kelas }}</h5>
            <p class="card-text"><strong>Trainer ID:</strong> {{ $gymClass->trainer_id }}</p>
            <p class="card-text"><strong>Deskripsi:</strong> {{ $gymClass->deskripsi }}</p>
            <p class="card-text"><strong>Waktu Mulai:</strong> {{ $gymClass->waktu_mulai }}</p>
            <p class="card-text"><strong>Waktu Selesai:</strong> {{ $gymClass->waktu_selesai }}</p>
            <p class="card-text"><strong>Durasi:</strong> {{ $gymClass->durasi }} menit</p>
            <p class="card-text"><strong>Kapasitas:</strong> {{ $gymClass->kapasitas }}</p>
            <a href="{{ route('gym_class.edit', $gymClass->class_id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('gym_class.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

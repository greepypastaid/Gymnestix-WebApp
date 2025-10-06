@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Detail Membership Plan</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama Plan:</strong> {{ $plan->nama_plan }}</p>
            <p><strong>Harga:</strong> {{ $plan->harga }}</p>
            <p><strong>Durasi:</strong> {{ $plan->periode_bulan }} bulan</p>
            <p><strong>Deskripsi:</strong> {{ $plan->deskripsi }}</p>
            <a href="{{ route('membership_plan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
    <h2 class="fw-bold mb-4">Detail Pembayaran</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Billing ID:</strong> {{ $billing->billing_id }}</p>
            <p><strong>Member ID:</strong> {{ $billing->member_id }}</p>
            <p><strong>Plan ID:</strong> {{ $billing->plan_id }}</p>
            <p><strong>Jumlah:</strong> {{ $billing->jumlah }}</p>
            <p><strong>Tanggal Tagihan:</strong> {{ $billing->tanggal_tagihan ? \Carbon\Carbon::parse($billing->tanggal_tagihan)->format('d/m/y') : '' }}</p>
            <p><strong>Tanggal Jatuh Tempo:</strong> {{ $billing->tanggal_jatuh_tempo ? \Carbon\Carbon::parse($billing->tanggal_jatuh_tempo)->format('d/m/y') : '' }}</p>
            <p><strong>Status Pembayaran:</strong> {{ $billing->status_pembayaran }}</p>
            <a href="{{ route('billing.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

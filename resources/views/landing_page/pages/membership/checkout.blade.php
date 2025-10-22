@extends('landing_page.layouts.app')

@section('title', 'Checkout Membership')

@section('content')
    <div class="max-w-3xl mx-auto py-12 px-6">
        <h2 class="text-2xl font-bold mb-4">Konfirmasi Pembelian Membership</h2>

        <div class="bg-white shadow p-6 rounded-lg">
            <h3 class="text-xl font-semibold">{{ $plan->nama_plan }}</h3>
            <p class="text-gray-500 mb-4">Rp {{ number_format($plan->harga, 0, ',', '.') }} / {{ $plan->periode_bulan }}
                bulan</p>

            <hr class="my-4">

            <p class="text-gray-700">Nomor VA: <strong>{{ $payment->va_number }}</strong></p>
            <p class="text-gray-700 mb-4">Status: <span class="font-medium capitalize">{{ $payment->status }}</span></p>

            <a href="{{ $payment->payment_url }}" target="_blank"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Bayar Sekarang
            </a>
        </div>
    </div>
@endsection

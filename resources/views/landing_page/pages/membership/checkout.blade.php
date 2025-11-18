@extends('landing_page.layouts.app')

@section('title', 'Checkout Membership')

@section('content')
    <div class="max-w-3xl mx-auto py-16 px-6 text-white">
        <h2 class="text-3xl font-heading font-bold my-8 text-center">
            Konfirmasi Pembelian Membership
        </h2>

        <div class="bg-neutral-900 border border-neutral-800 shadow-xl p-6 rounded-2xl">
            <div class="mb-4">
                <h3 class="text-2xl font-heading font-semibold text-primary">
                    {{ $plan->nama_plan }}
                </h3>
                <p class="text-gray-300 mt-1">
                    Rp {{ number_format($plan->harga, 0, ',', '.') }}
                    <span class="text-gray-400">/ {{ $plan->periode_bulan }} bulan</span>
                </p>
            </div>

            <hr class="border-neutral-700 my-5">

            <div class="space-y-2">
                <p class="text-gray-300">
                    Nomor VA: <strong class="text-white">{{ $payment->va_number }}</strong>
                </p>
                <p class="text-gray-300">
                    Status:
                    <span
                        class="font-medium capitalize
                        @if ($payment->status === 'pending') text-yellow-400
                        @elseif($payment->status === 'paid') text-green-400
                        @else text-red-400 @endif">
                        {{ $payment->status }}
                    </span>
                </p>
            </div>

            <a href="{{ $payment->payment_url }}" target="_blank"
                class="mt-6 inline-block w-full text-center bg-primary text-white
                      font-semibold py-3 rounded-xl hover:bg-emerald-700 transition">
                Bayar Sekarang
            </a>
        </div>

        <p class="text-center text-gray-400 text-sm mt-4">
            Setelah pembayaran berhasil, halaman ini akan otomatis terupdate.
        </p>
        <p id="checking-status" class="text-center text-gray-500 text-xs mt-2">
            Memeriksa status pembayaran...
        </p>
    </div>

    <script>
        const interval = setInterval(() => {
            fetch("{{ route('payment.checkStatus', $payment->id) }}")
                .then(res => res.json())
                .then(data => {
                    if (data.status === "paid") {
                        clearInterval(interval);
                        window.location.href = "{{ route('payment.successPage', $payment->id) }}";
                    }
                });
        }, 5000);
    </script>
@endsection

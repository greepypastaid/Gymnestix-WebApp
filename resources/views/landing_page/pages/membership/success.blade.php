@extends('landing_page.layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
    <div class="min-h-[70vh] flex items-center justify-center text-white px-6 py-20">
        <div class="bg-neutral-900 border border-neutral-800 shadow-xl p-8 rounded-2xl max-w-lg w-full text-center">

            {{-- Icon Success --}}
            <div class="flex justify-center mb-5">
                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-green-600/20">
                    <i class="fa fa-check text-3xl text-green-500"></i>
                </div>
            </div>

            <h1 class="text-3xl font-heading font-bold text-green-400 mb-3">
                Pembayaran Berhasil!
            </h1>

            <p class="text-gray-300 mb-6">
                Selamat, keanggotaan Gymnestix kamu sudah aktif 🎉
                Nikmati akses penuh ke semua fasilitas & kelas premium kami.
            </p>

            {{-- Payment Info --}}
            <div class="bg-neutral-800 border border-neutral-700 rounded-xl p-4 text-left space-y-3 mb-6">
                <div class="flex justify-between">
                    <span class="text-gray-400">External ID</span>
                    <span class="text-white font-medium">{{ $payment->external_id }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Nomor VA</span>
                    <span class="text-white font-medium">{{ $payment->va_number }}</span>
                </div>
            </div>

            <a href="#"
                class="inline-block bg-primary text-white px-6 py-3 rounded-xl hover:bg-emerald-700 transition font-semibold w-full">
                Mulai Latihan Sekarang
            </a>
        </div>
    </div>
@endsection

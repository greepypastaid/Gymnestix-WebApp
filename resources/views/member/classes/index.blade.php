@extends('landing_page.layouts.app')

@section('title', 'Kelas Saya')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-6 my-10">
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-gray-100">Kelas yang Kamu Ikuti</h1>
            <p class="text-gray-400 mt-1">Berikut daftar kelas yang sudah kamu join.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($classes as $booking)
                @php
                    $class = $booking->class; // relasi belongsTo pada Booking
                @endphp

                <div class="bg-neutral-900 border border-neutral-800 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-5">
                        <h2 class="text-xl font-bold text-[#ADFF2F] mb-1">
                            {{ $class->nama_kelas }}
                        </h2>

                        <p class="text-sm text-neutral-400 mb-3">
                            {{ Str::limit($class->deskripsi, 100) }}
                        </p>

                        <div class="flex justify-between text-sm text-neutral-500 mb-3">
                            <div>
                                <i class="bi bi-clock"></i>
                                {{ \Carbon\Carbon::parse($class->waktu_mulai)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($class->waktu_selesai)->format('H:i') }}
                            </div>
                            <div>
                                {{ $class->bookings_count ?? $class->bookings->count() }} / {{ $class->kapasitas }}
                            </div>
                        </div>

                        <div class="bg-[#ADFF2F]/20 border border-[#ADFF2F]/40 rounded-md p-3 text-sm mb-3">
                            <p class="text-[#ADFF2F] font-medium">
                                <i class="bi bi-check-circle"></i>
                                Kamu sudah bergabung
                            </p>

                            <p class="text-xs text-neutral-400 mt-1">
                                Bergabung pada:
                                <span class="text-white">
                                    {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y H:i') }}
                                </span>
                            </p>
                        </div>

                        <a href="#"
                            class="block text-center py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-md font-semibold transition">
                            Lihat Detail Kelas
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <i class="bi bi-emoji-frown text-4xl text-gray-500"></i>
                    <p class="text-gray-400 mt-3">Kamu belum bergabung dengan kelas manapun.</p>
                </div>
            @endforelse
            
           
        </div>
         <div class="flex py-5">
                <a href="{{ route('classes.index') }}" class="mx-auto">
                    <button class="block text-center p-2.5 bg-[#ADFF2F] hover:bg-[#ADFF2F]/80 text-black rounded-md font-semibold transition">
                        Gabung kelas lain
                    </button>
                </a>
            </div>
    </div>
@endsection

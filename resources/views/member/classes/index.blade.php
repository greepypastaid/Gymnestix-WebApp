@extends('landing_page.layouts.app')

@section('title', 'Kelas Saya')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:py-12 px-4 sm:px-6 lg:px-8 my-6 sm:my-10">
        <div class="mb-6 sm:mb-10">
            <h1 class="text-3xl font-bold text-white mb-1">Kelas yang Kamu Ikuti</h1>
            <p class="text-gray-400 text-sm">Berikut daftar kelas yang sudah kamu join</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($classes as $booking)
                @php
                    $class = $booking->class;
                @endphp

                <div class="group card-dark bg-[#1a1a1a] rounded-xl p-6 hover:shadow-lg hover:shadow-[#ADFF2F]/5 transition-all">
                    @if(!empty($class->cover) && file_exists(public_path('storage/' . $class->cover)))
                        <img src="{{ asset('storage/' . $class->cover) }}" alt="{{ $class->nama_kelas }} cover" class="w-full h-48 object-cover rounded-md mb-4" />
                    @else
                        <div class="w-full h-48 rounded-md mb-4 flex items-center justify-center text-neutral-400">
                        </div>
                    @endif

                    <h2 class="text-xl font-bold text-[#ADFF2F] mb-2">
                        {{ $class->nama_kelas }}
                    </h2>

                    <p class="text-sm text-neutral-300 mb-4">
                        {{ Str::limit($class->deskripsi, 100) }}
                    </p>

                    <div class="flex justify-between text-sm text-neutral-300 mb-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="leading-4">{{ \Carbon\Carbon::parse($class->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($class->waktu_selesai)->format('H:i') }}</span>
                        </div>
                        <div class="leading-4">
                            {{ $class->bookings_count ?? $class->bookings->count() }} / {{ $class->kapasitas }}
                        </div>
                    </div>

                    <div class="bg-[#ADFF2F]/12 border border-[#ADFF2F]/30 rounded-lg p-3 mb-4">
                        <p class="text-white font-medium text-sm flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#ADFF2F] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Kamu sudah bergabung
                        </p>
                        <p class="text-xs text-neutral-300 mt-1">
                            Bergabung pada: <span class="text-neutral-100">{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y H:i') }}</span>
                        </p>
                    </div>

                    <a href="{{ route('member.classes.show', $class) }}" class="w-full justify-center py-2.5 px-4 bg-[#ADFF2F] hover:bg-[#9DE626] text-[#0a0a0a] font-semibold rounded-lg text-center inline-flex items-center gap-2 transition-colors">
                        Lihat Detail Kelas
                    </a>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <div class="text-gray-400 mb-3">Kamu belum bergabung dengan kelas manapun</div>
                    <a href="{{ route('classes.index') }}" class="btn-primary-custom inline-flex items-center gap-2">
                        Gabung Kelas Sekarang
                    </a>
                </div>
            @endforelse
        </div>

        @if($classes->isNotEmpty())
            <div class="flex justify-center mt-8">
                <a href="{{ route('classes.index') }}" class="btn-primary-custom">
                    Gabung kelas lain
                </a>
            </div>
        @endif
    </div>
@endsection

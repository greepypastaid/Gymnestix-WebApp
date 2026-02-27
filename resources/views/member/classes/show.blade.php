@extends('landing_page.layouts.app')

@section('title', $class->nama_kelas)

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:py-12 px-4 sm:px-6 lg:px-8 my-6 sm:my-10">
        <div class="bg-[#1a1a1a] rounded-xl overflow-hidden flex">
            @if(!empty($class->cover) && file_exists(public_path('storage/' . $class->cover)))
                <img src="{{ asset('storage/' . $class->cover) }}" alt="{{ $class->nama_kelas }} cover" class="w-96 h-96 object-cover" />
            @else
                <div class="w-96 h-96 bg-gradient-to-r from-[#0a0a0a] to-[#1f1f1f] flex items-center justify-center">
                </div>
            @endif

            <div class="p-12">
                <h1 class="text-2xl font-bold text-[#ADFF2F] mb-2">{{ $class->nama_kelas }}</h1>
                <p class="text-sm text-neutral-300 mb-4">{{ $class->deskripsi }}</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div class="space-y-2">
                        <div class="text-xs text-neutral-400">Waktu</div>
                        <div class="font-medium text-white">{{ \Carbon\Carbon::parse($class->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($class->waktu_selesai)->format('H:i') }}</div>
                    </div>
                    <div class="space-y-2">
                        <div class="text-xs text-neutral-400">Kapasitas</div>
                        <div class="font-medium text-white">{{ $bookings_count }} / {{ $class->kapasitas }}</div>
                    </div>
                    @if($class->ruangan)
                        <div class="space-y-2">
                            <div class="text-xs text-neutral-400">Ruangan</div>
                            <div class="font-medium text-white">{{ $class->ruangan }}</div>
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    @if($joined)
                        <div class="bg-[#ADFF2F]/12 border border-[#ADFF2F]/30 rounded-lg p-3">
                            <p class="text-white font-medium">Kamu sudah bergabung</p>
                            @if($booking)
                                <p class="text-xs text-neutral-300 mt-1">Bergabung pada: <span class="text-neutral-100">{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y H:i') }}</span></p>
                            @endif
                        </div>
                    @else
                        <form action="{{ route('class.join', $class->class_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-primary-custom w-full">Gabung Kelas</button>
                        </form>
                    @endif
                </div>

                <a href="{{ route('member.classes.index') }}" class="py-2.5 px-4 bg-[#ADFF2F] hover:bg-[#9DE626] text-[#0a0a0a] font-semibold rounded-lg text-center inline-flex items-center gap-2 transition-colors">Kembali ke Kelas Saya</a>
            </div>
        </div>
    </div>
@endsection

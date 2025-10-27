@extends('landing_page.layouts.app')

@section('title', 'Daftar Kelas')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-6">
        <div class="flex items-center justify-between mb-10">
            <h1 class="text-3xl font-extrabold text-gray-800">
                🏋️‍♂️ Daftar Kelas Gymnestix
            </h1>
            <p class="text-gray-500">Pilih kelas yang ingin kamu ikuti sesuai jadwal dan rencana membership.</p>
        </div>

        {{-- Daftar Kelas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($classes as $class)
                @php
                    $joined = $userClasses ? $userClasses->contains('class_id', $class->class_id) : false;
                    $membership = $joined ? $userClasses->firstWhere('class_id', $class->class_id) : null;
                @endphp

                <div class="bg-white shadow-md hover:shadow-lg transition rounded-xl overflow-hidden border border-gray-100">
                    <div class="p-5">
                        <h2 class="text-xl font-bold text-green-700 mb-1">{{ $class->nama_kelas }}</h2>
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($class->deskripsi, 100) }}</p>

                        <div class="flex justify-between text-sm text-gray-500 mb-3">
                            <div><i class="bi bi-clock"></i> {{ $class->waktu_mulai }} - {{ $class->waktu_selesai }}</div>
                            <div><i class="bi bi-people"></i> Kapasitas: {{ $class->kapasitas }}</div>
                        </div>

                        @if ($joined)
                            <div class="bg-green-50 border border-green-100 rounded-md p-3 text-sm mb-3">
                                <p class="text-green-700 font-medium flex items-center gap-1">
                                    <i class="bi bi-check-circle-fill"></i>
                                    Sudah bergabung
                                </p>
                                @if ($membership && $membership->expired_at)
                                    <p class="text-xs text-gray-500 mt-1">
                                        Masa aktif sampai
                                        {{ \Carbon\Carbon::parse($membership->expired_at)->format('d M Y') }}
                                    </p>
                                @endif
                            </div>
                            <button disabled
                                class="w-full py-2.5 bg-gray-200 text-gray-500 font-medium rounded-md cursor-not-allowed">
                                Terdaftar
                            </button>
                        @else
                            <form action="{{ route('member.classes.join', $class->class_id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full py-2.5 bg-gradient-to-r from-green-600 to-emerald-500 text-white font-semibold rounded-md shadow hover:shadow-lg transition-all">
                                    Gabung Kelas
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <i class="bi bi-emoji-neutral text-4xl text-gray-400 mb-3"></i>
                    <p class="text-gray-600 font-medium">Belum ada kelas yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

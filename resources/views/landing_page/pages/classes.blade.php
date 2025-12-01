@extends('landing_page.layouts.app')

@section('title', 'Daftar Kelas')

@section('content')
    <div class="relative bg-black pt-32 overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-left mb-4">
                <h1 class="text-5xl md:text-6xl font-poppins text-white mb-4">
                    Daftar Kelas Gymnestix
                </h1>
                <p class="text-left text-neutral-400 text-lg max-w-2xl">
                    Pilih kelas yang sesuai dengan tujuan dan jadwalmu. Bergabung sekarang dan mulai transformasi!
                </p>
            </div>
        </div>
    </div>

    <div class="bg-black pt-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($classes as $class)
                    @php
                        $membership = $userClasses ? $userClasses->firstWhere('class_id', $class->class_id) : null;
                        $joined = $membership !== null;

                        $count = $class->bookings_count ?? $class->bookings->count();
                        $isFull = $count >= (int)$class->kapasitas;

                        $pendingIds = session('pending_bookings', []);
                        $isPending = !$isFull && in_array($class->class_id, $pendingIds);
                    @endphp

                    <div class="group bg-neutral-900 p-8 rounded-2xl border border-neutral-800 hover:border-[#ADFF2F]/50 transition-all duration-300 hover:-translate-y-2">
                        
                        <div class="relative w-full h-48 mb-4 rounded-xl bg-neutral-800 overflow-hidden group-hover:bg-[#ADFF2F] transition-all duration-300">
                            
                            <div class="w-full h-full flex items-center justify-center text-[#ADFF2F] group-hover:text-black transition-colors duration-300">
                                <img src="" alt="Coming Soon Update From BE!" class="text-center p-4">
                            </div>

                            <div class="absolute top-3 right-3 z-10">
                                @if ($joined)
                                    <span class="text-xs font-bold text-black bg-[#ADFF2F] px-3 py-1 rounded-full shadow-lg">
                                        Terdaftar
                                    </span>
                                @elseif ($isFull)
                                    <span class="text-xs font-bold text-white bg-red-600 px-3 py-1 rounded-full shadow-lg">Penuh</span>
                                @elseif ($isPending)
                                    <span class="text-xs font-bold text-white bg-neutral-600 px-3 py-1 rounded-full shadow-lg">Proses</span>
                                @endif
                            </div>
                        </div>
                        <h3 class="text-xl font-poppins font-semibold text-white mb-3">
                            {{ $class->nama_kelas }}
                        </h3>

                        <p class="text-neutral-400 text-sm mb-4 leading-relaxed">
                            {{ Str::limit($class->deskripsi, 100) }}
                        </p>

                        <div class="flex flex-col gap-2 mb-6 text-sm text-neutral-300">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-clock text-[#ADFF2F]"></i>
                                <span>{{ $class->waktu_mulai }} - {{ $class->waktu_selesai }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-user-group text-[#ADFF2F]"></i>
                                <span>{{ $count }} / {{ $class->kapasitas }}</span>
                            </div>
                        </div>

                        @if ($joined)
                            @if ($membership && $membership->expired_at)
                                <p class="text-xs text-neutral-500 mb-3">
                                    Aktif sampai {{ \Carbon\Carbon::parse($membership->expired_at)->format('d M Y') }}
                                </p>
                            @endif

                            <button disabled
                                class="w-full py-3 bg-neutral-800 text-neutral-500 font-semibold rounded-lg cursor-not-allowed border border-neutral-700">
                                Sudah Terdaftar
                            </button>
                        @elseif ($isFull)
                            <button disabled
                                class="w-full py-3 bg-red-600 text-white font-semibold rounded-lg cursor-not-allowed border border-neutral-700">
                                Kelas Penuh
                            </button>
                        @elseif ($isPending)
                            <button disabled
                                class="w-full py-3 bg-neutral-800 text-neutral-500 font-semibold rounded-lg cursor-not-allowed border border-neutral-800">
                                Tunggu konfirmasi
                            </button>
                        @else
                            <form action="{{ route('member.classes.join', $class->class_id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full py-3 bg-[#ADFF2F] text-black font-semibold rounded-lg hover:bg-[#9DE626] transition-all duration-300 hover:scale-105">
                                    Gabung Kelas
                                </button>
                            </form>
                        @endif
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16">
                        <div class="inline-block p-4 bg-neutral-800 rounded-full mb-4">
                            <i class="fa-solid fa-inbox text-4xl text-neutral-600"></i>
                        </div>
                        <p class="text-neutral-400 text-lg font-medium">Belum ada kelas yang tersedia saat ini.</p>
                        <p class="text-neutral-500 text-sm mt-2">Cek kembali nanti atau hubungi admin untuk info lebih
                            lanjut.</p>
                    </div>
                @endforelse
            </div>

            @if ($classes instanceof \Illuminate\Pagination\LengthAwarePaginator && $classes->hasPages())
                <div class="mt-12 flex justify-center">
                    <nav class="inline-flex rounded-lg bg-neutral-800 overflow-hidden">
                        {{-- Previous Button --}}
                        @if ($classes->onFirstPage())
                            <span class="px-4 py-3 text-neutral-600 cursor-not-allowed">
                                <i class="fa-solid fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $classes->previousPageUrl() }}"
                                class="px-4 py-3 text-neutral-300 hover:bg-neutral-700 hover:text-[#ADFF2F] transition-colors">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($classes->getUrlRange(1, $classes->lastPage()) as $page => $url)
                            @if ($page == $classes->currentPage())
                                <span class="px-4 py-3 bg-[#ADFF2F] text-black font-semibold">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="px-4 py-3 text-neutral-300 hover:bg-neutral-700 hover:text-[#ADFF2F] transition-colors">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        {{-- Next Button --}}
                        @if ($classes->hasMorePages())
                            <a href="{{ $classes->nextPageUrl() }}"
                                class="px-4 py-3 text-neutral-300 hover:bg-neutral-700 hover:text-[#ADFF2F] transition-colors">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="px-4 py-3 text-neutral-600 cursor-not-allowed">
                                <i class="fa-solid fa-chevron-right"></i>
                            </span>
                        @endif
                    </nav>
                </div>

                {{-- Page Info --}}
                <div class="mt-4 text-center text-sm text-neutral-500">
                    Menampilkan {{ $classes->firstItem() }} - {{ $classes->lastItem() }} dari {{ $classes->total() }}
                    kelas
                </div>
            @endif
        </div>
    </div>

    <div class="relative bg-black py-20">
        <div class="max-w-7xl mx-auto text-center">
            <div class="bg-gradient-to-br from-neutral-900 to-neutral-950 border border-neutral-800 rounded-3xl p-12">
                <h2 class="text-4xl font-poppins font-semibold text-white mb-4">
                    Siap Memulai Perjalanan Fitness Anda?
                </h2>
                <p class="text-neutral-400 mb-8 max-w-2xl mx-auto">
                    Bergabunglah dengan ribuan member yang sudah merasakan transformasi luar biasa bersama Gymnestix.
                </p>
                <div class="flex gap-4 justify-center">
                    <a href="{{ route('pricing') }}#pricing"
                        class="bg-[#ADFF2F] text-black px-8 py-3 rounded-full font-medium hover:bg-[#9DE625] transition-all duration-300 hover:scale-105">
                        Lihat Paket Membership
                    </a>
                    <a href="{{ route('trainers.index') }}"
                        class="bg-neutral-800 text-white px-8 py-3 rounded-full font-medium hover:bg-neutral-700 transition-all duration-300 border border-neutral-700">
                        Kenali Trainer Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
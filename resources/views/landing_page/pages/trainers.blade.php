@extends('landing_page.layouts.app')

@section('title', 'Daftar Trainer')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-black pt-32 overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-left mb-4">
                <h1 class="text-5xl md:text-6xl font-poppins text-white mb-4">
                    Daftar Tenaga Profesional Kami
                </h1>
                <p class="text-left text-neutral-400 text-lg max-w-2xl">
                    Pilih trainer kesukaan kamu untuk membuatmu lebih baik!
                </p>
            </div>
        </div>
    </div>

    <!-- Trainers Grid Section -->
    <div class="bg-black py-12">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($trainers as $trainer)
                    <div class="group bg-neutral-900 p-8 rounded-2xl border border-neutral-800 hover:border-[#ADFF2F]/50 transition-all duration-300 hover:-translate-y-2">
                        <!-- Icon & Badge -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-full h-48 flex items-center justify-center rounded-xl bg-neutral-800 text-[#ADFF2F] text-xl group-hover:bg-[#ADFF2F] group-hover:text-black transition-all duration-300">
                                <!-- <i class="fa-solid fa-users" aria-hidden="true"></i> -->
                                 <img src="" alt="Coming Soon Update From BE!" class=text-black>
                            </div>
                        </div>

                        <!-- Trainer Name -->
                        <h3 class="text-xl font-poppins font-semibold text-white mb-1">
                            {{ $trainer->user->nama ?? 'Trainer' }}
                        </h3>
                        
                        <!-- Specialization -->
                        <p class="text-[#ADFF2F] text-sm font-medium mb-3">
                            {{ $trainer->spesialisasi ?? 'Personal Trainer' }}
                        </p>

                        <!-- Bio / Description -->
                        @if($trainer->bio)
                            <p class="text-neutral-400 text-sm mb-4 leading-relaxed">
                                {{ Str::limit($trainer->bio, 100) }}
                            </p>
                        @endif

                        <!-- Info -->
                        <div class="flex flex-col gap-2 mb-6 text-sm text-neutral-300">
                            @if($trainer->sertifikasi)
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-certificate text-[#ADFF2F]"></i>
                                    <span class="truncate">{{ Str::limit($trainer->sertifikasi, 40) }}</span>
                                </div>
                            @endif
                            @if($trainer->user && $trainer->user->email)
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-envelope text-[#ADFF2F]"></i>
                                    <span class="truncate">{{ $trainer->user->email }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Contact / Schedule Button -->
                        <a href="{{ route('classes.index') }}" 
                           class="block w-full py-3 text-center bg-[#ADFF2F] text-black font-semibold rounded-lg hover:bg-[#9DE626] transition-all duration-300 hover:scale-105">
                            Lihat Kelas
                        </a>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16">
                        <div class="inline-block p-4 bg-neutral-800 rounded-full mb-4">
                            <i class="fa-solid fa-user-slash text-4xl text-neutral-600"></i>
                        </div>
                        <p class="text-neutral-400 text-lg font-medium">Belum ada trainer yang tersedia saat ini.</p>
                        <p class="text-neutral-500 text-sm mt-2">Cek kembali nanti atau hubungi admin untuk info lebih lanjut.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($trainers instanceof \Illuminate\Pagination\LengthAwarePaginator && $trainers->hasPages())
                <div class="mt-12 flex justify-center">
                    <nav class="inline-flex rounded-lg border border-neutral-700 bg-neutral-800 overflow-hidden">
                        {{-- Previous Button --}}
                        @if ($trainers->onFirstPage())
                            <span class="px-4 py-3 text-neutral-600 cursor-not-allowed">
                                <i class="fa-solid fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $trainers->previousPageUrl() }}" 
                               class="px-4 py-3 text-neutral-300 hover:bg-neutral-700 hover:text-[#ADFF2F] transition-colors">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($trainers->getUrlRange(1, $trainers->lastPage()) as $page => $url)
                            @if ($page == $trainers->currentPage())
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
                        @if ($trainers->hasMorePages())
                            <a href="{{ $trainers->nextPageUrl() }}" 
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
                    Menampilkan {{ $trainers->firstItem() }} - {{ $trainers->lastItem() }} dari {{ $trainers->total() }} trainer
                </div>
            @endif
        </div>
    </div>

    <!-- CTA Section -->
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
                    <a href="{{ route('pricing') }}#pricing" class="bg-[#ADFF2F] text-black px-8 py-3 rounded-full font-medium hover:bg-[#9DE625] transition-all duration-300 hover:scale-105">
                        Lihat Paket Membership
                    </a>
                    <a href="{{ route('trainers.index') }}" class="bg-neutral-800 text-white px-8 py-3 rounded-full font-medium hover:bg-neutral-700 transition-all duration-300 border border-neutral-700">
                        Kenali Trainer Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

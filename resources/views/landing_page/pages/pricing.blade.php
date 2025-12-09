@extends('landing_page.layouts.app')

@section('title', 'Paket Membership')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-black pt-20 sm:pt-24 md:pt-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex flex-col text-left mb-6 sm:mb-8">
                <h1 class="text-left text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-poppins text-white mb-4 sm:mb-6">
                    Pilih Paket yang Tepat untuk Anda
                </h1>
                <p class="text-neutral-400 text-sm sm:text-base lg:text-lg max-w-3xl">
                    Mulai dengan paket dasar gratis selama 30 hari. Ganti paket atau batalkan kapan saja.
                </p>
            </div>
        </div>
    </div>

    <!-- Pricing Cards Section -->
    <div class="relative bg-black py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- 2 kolom untuk md, 3 kolom untuk lg -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8" id="pricing-cards">
                @forelse($membershipPlans as $index => $plan)
                    @php
                        $isPopular = $index === 1; // Middle plan is popular
                        $features = json_decode($plan->features ?? '[]', true);
                        if (!is_array($features)) {
                            $features = [];
                        }
                    @endphp

                    <div class="group relative bg-neutral-900 p-6 md:p-6 lg:p-8 rounded-2xl border {{ $isPopular ? 'border-[#ADFF2F]' : 'border-neutral-800' }} transition-all duration-300 md:hover:-translate-y-2 flex flex-col h-full">
                        <!-- Popular Badge: right aligned on small/md, centered on lg -->
                        @if($isPopular)
                            <div class="absolute -top-4 right-4 lg:left-1/2 lg:-translate-x-1/2 lg:right-auto">
                                <span class="bg-[#ADFF2F] text-black text-xs font-bold px-4 py-1 rounded-full">
                                    TERPOPULER
                                </span>
                            </div>
                        @endif

                        <!-- Plan Header -->
                        <div class="mb-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center rounded-xl bg-neutral-800 text-[#ADFF2F] group-hover:bg-[#ADFF2F] group-hover:text-black transition-all duration-300">
                                    <i class="fa-solid {{ $index === 0 ? 'fa-gift' : ($index === 1 ? 'fa-star' : 'fa-crown') }} text-sm sm:text-base"></i>
                                </div>
                                <div>
                                    <h3 class="text-base sm:text-lg md:text-xl font-poppins font-bold text-white">{{ $plan->nama_plan }}</h3>
                                    <p class="text-xs sm:text-sm text-neutral-400">{{ $plan->deskripsi ?? 'Paket membership' }}</p>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="mb-4">
                                <div class="flex items-baseline gap-2">
                                    <span class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white">Rp{{ number_format($plan->harga, 0, ',', '.') }}</span>
                                    <span class="text-neutral-400 text-sm sm:text-base md:text-lg">/{{ $plan->periode_bulan }} bulan</span>
                                </div>
                                <p class="text-sm text-neutral-500 mt-1">
                                    ~Rp{{ number_format($plan->harga / max(1, $plan->periode_bulan), 0, ',', '.') }}/bulan
                                </p>
                            </div>

                            <!-- CTA Button (placed right after price for visibility) -->
                            @auth
                                <a href="{{ route('membership.checkout', $plan->plan_id) }}" 
                                   class="inline-block w-full py-3 text-center {{ $isPopular ? 'bg-[#ADFF2F] text-black hover:bg-[#9DE626]' : 'bg-neutral-800 text-white hover:bg-neutral-700' }} font-semibold rounded-lg transition-all duration-300 hover:scale-105 mb-4">
                                    {{ $index === 0 ? 'Mulai Gratis' : 'Mulai Sekarang' }}
                                </a>
                            @else
                                <a href="{{ route('register') }}" 
                                   class="inline-block w-full py-3 text-center {{ $isPopular ? 'bg-[#ADFF2F] text-black hover:bg-[#9DE626]' : 'bg-neutral-800 text-white hover:bg-neutral-700' }} font-semibold rounded-lg transition-all duration-300 hover:scale-105 mb-4">
                                    Daftar Sekarang
                                </a>
                            @endauth
                        </div>

                        <!-- Features List -->
                        <div class="pt-6 border-t border-neutral-800 mt-auto">
                            <p class="text-sm font-semibold text-neutral-400 mb-4">Fitur yang Termasuk:</p>
                            <ul class="space-y-3">
                                @if(!empty($features) && count($features) > 0)
                                    @foreach($features as $feature)
                                        <li class="flex items-start gap-3 text-sm text-neutral-300">
                                            <i class="fa-solid fa-circle-check text-[#ADFF2F] mt-0.5 flex-shrink-0"></i>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <!-- Default features if none specified -->
                                    <li class="flex items-start gap-3 text-sm text-neutral-300">
                                        <i class="fa-solid fa-circle-check text-[#ADFF2F] mt-0.5 flex-shrink-0"></i>
                                        <span>Akses ke semua peralatan gym</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-sm text-neutral-300">
                                        <i class="fa-solid fa-circle-check text-[#ADFF2F] mt-0.5 flex-shrink-0"></i>
                                        <span>Loker & shower premium</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-sm text-neutral-300">
                                        <i class="fa-solid fa-circle-check text-[#ADFF2F] mt-0.5 flex-shrink-0"></i>
                                        <span>Akses aplikasi booking</span>
                                    </li>
                                    @if($index >= 1)
                                        <li class="flex items-start gap-3 text-sm text-neutral-300">
                                            <i class="fa-solid fa-circle-check text-[#ADFF2F] mt-0.5 flex-shrink-0"></i>
                                            <span>Kelas grup unlimited</span>
                                        </li>
                                        <li class="flex items-start gap-3 text-sm text-neutral-300">
                                            <i class="fa-solid fa-circle-check text-[#ADFF2F] mt-0.5 flex-shrink-0"></i>
                                            <span>Konsultasi dengan trainer</span>
                                        </li>
                                    @endif
                                    @if($index >= 2)
                                        <li class="flex items-start gap-3 text-sm text-neutral-300">
                                            <i class="fa-solid fa-circle-check text-[#ADFF2F] mt-0.5 flex-shrink-0"></i>
                                            <span>Personal training session</span>
                                        </li>
                                        <li class="flex items-start gap-3 text-sm text-neutral-300">
                                            <i class="fa-solid fa-circle-check text-[#ADFF2F] mt-0.5 flex-shrink-0"></i>
                                            <span>Program workout custom</span>
                                        </li>
                                        <li class="flex items-start gap-3 text-sm text-neutral-300">
                                            <i class="fa-solid fa-circle-check text-[#ADFF2F] mt-0.5 flex-shrink-0"></i>
                                            <span>Prioritas booking kelas</span>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16">
                        <div class="inline-block p-4 bg-neutral-800 rounded-full mb-4">
                            <i class="fa-solid fa-inbox text-4xl text-neutral-600"></i>
                        </div>
                        <p class="text-neutral-400 text-lg font-medium">Belum ada paket membership yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Comparison Table Section (only show on large screens) -->
    @if($membershipPlans->count() > 0)
    <div class="relative bg-black py-12 sm:py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-poppins font-bold text-white mb-3 sm:mb-4">
                    Bandingkan Semua Fitur
                </h2>
                <p class="text-neutral-400">
                    Lihat detail lengkap untuk setiap paket membership
                </p>
            </div>

            <!-- Table for extra large screens only (lg+) -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b border-neutral-800">
                            <th class="text-left py-4 px-6 text-white font-semibold">Fitur</th>
                            @foreach($membershipPlans as $plan)
                                <th class="text-center py-4 px-6 text-white font-semibold">{{ $plan->nama_plan }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-neutral-300">
                        @php
                            $comparisonFeatures = [
                                'Akses gym 24/7' => array_fill(0, $membershipPlans->count(), true),
                                'Loker & shower' => array_fill(0, $membershipPlans->count(), true),
                                'Kelas grup' => array_pad([false], $membershipPlans->count(), true),
                                'Personal training' => array_pad([false, false], $membershipPlans->count(), true),
                                'Konsultasi nutrisi' => array_pad([false, false], $membershipPlans->count(), true),
                                'Prioritas booking' => array_pad([false, false], $membershipPlans->count(), true),
                            ];
                        @endphp

                        @foreach($comparisonFeatures as $feature => $values)
                            <tr class="border-b border-neutral-800/50 hover:bg-neutral-900/50">
                                <td class="py-4 px-6 text-sm">{{ $feature }}</td>
                                @foreach($membershipPlans as $index => $plan)
                                    <td class="py-4 px-6 text-center">
                                        @php
                                            $value = $values[$index] ?? false;
                                        @endphp
                                        @if(is_bool($value))
                                            @if($value)
                                                <i class="fa-solid fa-circle-check text-[#ADFF2F] text-lg"></i>
                                            @else
                                                <i class="fa-solid fa-minus text-neutral-700"></i>
                                            @endif
                                        @else
                                            <span class="text-white font-medium">{{ $value }}</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile / md friendly version (cards) -->
            <div class="lg:hidden space-y-6">
                @foreach($membershipPlans as $planIndex => $plan)
                    <div class="bg-neutral-900 p-6 rounded-xl border border-neutral-800">
                        <h3 class="text-xl font-bold text-white mb-4">{{ $plan->nama_plan }}</h3>
                        @foreach($comparisonFeatures as $feature => $values)
                            <div class="flex items-center justify-between py-2 border-b border-neutral-800/50 last:border-0">
                                <span class="text-sm text-neutral-400">{{ $feature }}</span>
                                <span>
                                    @php
                                        $value = $values[$planIndex] ?? false;
                                    @endphp
                                    @if(is_bool($value))
                                        @if($value)
                                            <i class="fa-solid fa-circle-check text-[#ADFF2F]"></i>
                                        @else
                                            <i class="fa-solid fa-minus text-neutral-700"></i>
                                        @endif
                                    @else
                                        <span class="text-white font-medium">{{ $value }}</span>
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- CTA Section -->
    <div class="relative bg-black py-12 sm:py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 text-center">
            <div class="bg-gradient-to-br from-neutral-900 to-neutral-950 border border-neutral-800 rounded-2xl sm:rounded-3xl p-6 sm:p-8 md:p-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-poppins font-semibold text-white mb-3 sm:mb-4">
                    Masih Ragu? Hubungi Kami!
                </h2>
                <p class="text-neutral-400 text-sm sm:text-base mb-6 sm:mb-8 max-w-2xl mx-auto">
                    Tim kami siap membantu Anda memilih paket yang tepat sesuai kebutuhan dan tujuan fitness Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center flex-wrap">
                    <a href="https://wa.me/+6282325031004" class="bg-[#ADFF2F] text-black px-6 sm:px-8 py-2.5 sm:py-3 rounded-full font-medium hover:bg-[#9DE626] transition-all duration-300 hover:scale-105 text-sm sm:text-base">
                        Hubungi Kami
                    </a>
                    <a href="{{ route('features') }}" class="bg-neutral-800 text-white px-6 sm:px-8 py-2.5 sm:py-3 rounded-full font-medium hover:bg-neutral-700 transition-all duration-300 border border-neutral-700 text-sm sm:text-base">
                        Lihat Semua Fitur
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

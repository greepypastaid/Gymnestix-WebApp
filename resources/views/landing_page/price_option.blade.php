<section id="harga" class="py-20 bg-black relative overflow-hidden">
        <!-- Decorative background blobs -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-[#ADFF2F]/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#ADFF2F]/10 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-6xl font-poppins text-white mb-6">
                    Paket yang Sempurna untuk Kebutuhanmu
                </h2>
                <p class="text-neutral-400 font-poppins text-lg max-w-2xl mx-auto">
                    Harga transparan kami memudahkan kamu menemukan paket yang sesuai dengan budget dan tujuan kebugaran.
                </p>
            </div>

            <!-- Pricing Cards Grid -->
            <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6 max-w-5xl mx-auto">
                @forelse ($membershipPlans as $index => $p)
                    @php
                        // Mark the middle plan as recommended (or customize logic)
                        $isRecommended = $index === 1 || $p->nama_plan === 'Premium';
                    @endphp
                    
                    <div class="group relative bg-neutral-800 rounded-3xl border {{ $isRecommended ? 'border-[#ADFF2F]' : 'border-neutral-700' }} p-8 hover:border-[#ADFF2F]/50 transition-all duration-300 {{ $isRecommended ? 'lg:scale-105 shadow-2xl shadow-[#ADFF2F]/20' : '' }}">
                        
                        <!-- Recommended Badge -->
                        @if ($isRecommended)
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                                <span class="inline-block bg-[#ADFF2F] text-black text-xs font-semibold px-4 py-1.5 rounded-full">
                                    Rekomendasi
                                </span>
                            </div>
                        @endif

                        <!-- Plan Name -->
                        <h3 class="text-[#ADFF2F] font-poppins font-bold text-2xl mb-2">
                            {{ $p->nama_plan }}
                        </h3>

                        <!-- Price -->
                        <div class="mb-6">
                            <span class="text-5xl font-bold text-white">Rp{{ number_format($p->harga / 1000, 0) }}K</span>
                            <span class="text-neutral-400 text-lg">/{{ $p->periode_bulan }}mo</span>
                        </div>

                        <!-- Referral bonus (optional, customize as needed) -->
                        <p class="text-sm text-neutral-500 mb-6">
                            Bonus referral hingga <span class="text-[#ADFF2F] font-semibold">Rp{{ number_format($p->harga * 0.1 / 1000, 0) }}K</span>
                        </p>

                        <!-- Description / Features -->
                        <div class="mb-8">
                            <p class="text-neutral-400 text-sm font-semibold mb-3">{{ $p->deskripsi }}</p>
                            
                            <!-- Feature list (you can customize or fetch from DB) -->
                            <ul class="space-y-2.5">
                                <li class="flex items-start gap-2 text-neutral-300 text-sm">
                                    <i class="fa-solid fa-check text-[#ADFF2F] mt-0.5"></i>
                                    <span>Akses gym tanpa batas</span>
                                </li>
                                <li class="flex items-start gap-2 text-neutral-300 text-sm">
                                    <i class="fa-solid fa-check text-[#ADFF2F] mt-0.5"></i>
                                    <span>Semua kelas tersedia</span>
                                </li>
                                <li class="flex items-start gap-2 text-neutral-300 text-sm">
                                    <i class="fa-solid fa-check text-[#ADFF2F] mt-0.5"></i>
                                    <span>Konsultasi personal trainer</span>
                                </li>
                                @if ($isRecommended)
                                <li class="flex items-start gap-2 text-neutral-300 text-sm">
                                    <i class="fa-solid fa-check text-[#ADFF2F] mt-0.5"></i>
                                    <span>Booking prioritas & event eksklusif</span>
                                </li>
                                @endif
                            </ul>
                        </div>

                        <!-- CTA Button -->
                        <a href="{{ route('membership.checkout', $p->plan_id) }}"
                            class="block w-full text-center py-3.5 rounded-xl font-semibold transition-all duration-300 {{ $isRecommended ? 'bg-[#ADFF2F] text-black hover:bg-white' : 'bg-neutral-800 text-white hover:bg-neutral-700 border border-neutral-700' }}">
                            Pilih Paket
                        </a>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-neutral-500 text-lg">Belum ada paket tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Bottom CTA Banner -->
            <div class="mt-16 max-w-6xl mx-auto">
                <div class="relative bg-neutral-800 rounded-3xl p-8 flex flex-col md:flex-row items-center justify-between gap-6 overflow-hidden">                    
                    <div class="relative z-10">
                        <h3 class="text-2xl font-poppins font-bold text-white mb-2">
                            Ambil Cepat untuk Dapatkan Harga Spesial
                        </h3>
                        <p class="text-neutral-400">Penawaran terbatas — bergabung hari ini dan hemat lebih banyak!</p>
                    </div>
                    
                    <a href="{{ route('register') }}" 
                       class="relative z-10 bg-[#ADFF2F] text-black px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-black transition-all shadow-lg whitespace-nowrap">
                        Daftar Sekarang!
                    </a>
                </div>
            </div>
        </div>
    </section>
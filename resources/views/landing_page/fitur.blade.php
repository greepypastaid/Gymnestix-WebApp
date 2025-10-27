<section id="fitur" class="py-20 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-[#ADFF2F]/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-[#ADFF2F]/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto justify-center">
            <div class="flex justify-between items-stretch gap-8">
                <h2 class="w-1/2 text-left text-6xl font-poppins font-base">Temui Fitur Unggulan Kami!</h2>
                <div class="w-1/3 flex flex-col justify-end">
                    <p class="text-neutral-400 text-right">Fasilitas lengkap, pelatih berpengalaman, dan komunitas suportif yang dirancang untuk hasil nyata. Coba sekali, rasakan bedanya.</p>
                </div>
            </div>
            @php
            $features = [
            [
            'title' => 'Area Functional & Strength',
            'desc' => 'Ruang luas untuk beban bebas, rack, dan latihan fungsional.',
            'icon' => 'fa-solid fa-dumbbell',
            ],
            [
            'title' => 'Cardio Theater',
            'desc' => 'Treadmill, bike, dan rower modern untuk sesi kardio bervariasi.',
            'icon' => 'fa-solid fa-heart-pulse',
            ],
            [
            'title' => 'Kelas Harian',
            'desc' => 'HIIT, Yoga, Strength, Mobility—pilih sesuai preferensi.',
            'icon' => 'fa-solid fa-people-group',
            ],
            [
            'title' => 'Aplikasi Booking',
            'desc' => 'Booking kelas & konsultasi pelatih langsung dari ponsel.',
            'icon' => 'fa-solid fa-mobile-screen-button',
            ],
            [
            'title' => 'Loker & Shower',
            'desc' => 'Kenyamanan penuh setelah sesi latihan intens.',
            'icon' => 'fa-solid fa-shower',
            ],
            [
            'title' => 'Community Event',
            'desc' => 'Komunitas suportif dengan event bulanan.',
            'icon' => 'fa-solid fa-handshake-angle',
            ],
            ];
            @endphp

            <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6 mt-16">
                @foreach ($features as $f)
                <div class="bg-neutral-800 p-6 rounded-xl shadow hover:-translate-y-1 hover:shadow-lg transition">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full bg-neutral-900 text-[#ADFF2F] mb-3">
                        @if (!empty($f['icon']))
                            <i class="{{ $f['icon'] }}" aria-hidden="true"></i>
                        @else
                            <i class="fa-solid fa-award" aria-hidden="true"></i>
                        @endif
                    </div>
                    <h3 class="text-lg font-semibold mb-1">{{ $f['title'] }}</h3>
                    <p class="text-neutral-400 text-sm">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
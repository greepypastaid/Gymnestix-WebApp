<section id="fitur" class="py-20">
        <div class="max-w-7xl mx-auto px-6 justify-center">
            <h2 class="text-left text-6xl font-poppins font-base">Temui Fitur Unggulan Kami!</h2>
            <p class="text-neutral-400 mt-6">Fasilitas lengkap, pelatih berpengalaman, dan komunitas suportif yang dirancang untuk hasil nyata. Coba sekali, rasakan bedanya.</p>

            @php
            $features = [
            [
            'title' => 'Area Functional & Strength',
            'desc' => 'Ruang luas untuk beban bebas, rack, dan latihan fungsional.',
            ],
            [
            'title' => 'Cardio Theater',
            'desc' => 'Treadmill, bike, dan rower modern untuk sesi kardio bervariasi.',
            ],
            ['title' => 'Kelas Harian', 'desc' => 'HIIT, Yoga, Strength, Mobility—pilih sesuai preferensi.'],
            [
            'title' => 'Aplikasi Booking',
            'desc' => 'Booking kelas & konsultasi pelatih langsung dari ponsel.',
            ],
            ['title' => 'Loker & Shower', 'desc' => 'Kenyamanan penuh setelah sesi latihan intens.'],
            ['title' => 'Community Event', 'desc' => 'Komunitas suportif dengan event bulanan.'],
            ];
            @endphp

            <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6 mt-10">
                @foreach ($features as $f)
                <div class="bg-neutral-800 p-6 rounded-xl shadow hover:-translate-y-1 hover:shadow-lg transition">
                    <div
                        class="w-12 h-12 flex items-center justify-center rounded-full bg-green-100 text-green-600 mb-3">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-1">{{ $f['title'] }}</h3>
                    <p class="text-gray-500 text-sm">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
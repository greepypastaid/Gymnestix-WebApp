@extends('landing_page.layouts.app')

@section('title', 'Gymnestix - Bangun Versi Terkuatmu')
@section('meta_description',
    'Gym modern dengan fasilitas lengkap, kelas beragam, dan pelatih bersertifikat. Coba kelas
    gratis hari ini!')

@section('content')
    {{-- Hero --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 items-center gap-10">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">
                    Bangun <span class="text-green-600">Versi Terkuatmu</span> di Gymnestix
                </h1>
                <p class="mt-4 text-gray-600 text-lg">
                    Fasilitas premium, kelas bervariasi, dan pelatih bersertifikat siap membantu Anda mencapai tujuan
                    kebugaran — dari pemula hingga atlet.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 mt-6">
                    <a href="#daftar"
                        class="px-6 py-3 bg-green-600 text-white rounded-lg text-lg font-semibold hover:bg-green-700 transition">
                        Coba Kelas Gratis
                    </a>
                    <a href="#fitur"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg text-lg font-semibold hover:border-green-600 hover:text-green-600 transition">
                        Lihat Fitur
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-3 mt-6 text-gray-600 text-sm">
                    <div class="flex items-center gap-2"><i class="bi bi-clock text-yellow-500"></i> 24/7 Akses</div>
                    <div class="flex items-center gap-2"><i class="bi bi-person-check text-yellow-500"></i> Pelatih
                        Bersertifikat</div>
                    <div class="flex items-center gap-2"><i class="bi bi-calendar-check text-yellow-500"></i> Kelas Harian
                    </div>
                    <div class="flex items-center gap-2"><i class="bi bi-trophy text-yellow-500"></i> Peralatan Premium
                    </div>
                </div>
            </div>

            <div class="rounded-3xl overflow-hidden shadow-lg border border-gray-200">
                <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=1600&auto=format&fit=crop"
                    alt="Member latihan angkat beban di gym"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
            </div>
        </div>
    </section>

    {{-- Fitur --}}
    <section id="fitur" class="py-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold">Fitur Unggulan</h2>
            <p class="text-gray-500 mt-2">Semua yang Anda butuhkan untuk progres yang konsisten.</p>

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
                    <div class="bg-white p-6 rounded-xl shadow hover:-translate-y-1 hover:shadow-lg transition">
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

    {{-- Kelas --}}
    <section id="kelas" class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-bold">Kelas Populer</h2>
                    <p class="text-gray-500">Pilih kelas yang sesuai dengan tujuan Anda.</p>
                </div>
                <a href="#daftar"
                    class="hidden md:inline-block px-5 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition">
                    Lihat Jadwal
                </a>
            </div>

            @php
                $classes = [
                    ['name' => 'HIIT Burn', 'desc' => 'Latihan intensitas tinggi untuk membakar kalori cepat.'],
                    [
                        'name' => 'Power Lifting',
                        'desc' => 'Fokus kekuatan: squat, bench, deadlift dengan teknik benar.',
                    ],
                    ['name' => 'Mobility Flow', 'desc' => 'Perbaiki mobilitas dan kurangi risiko cedera.'],
                ];
            @endphp

            <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6">
                @foreach ($classes as $c)
                    <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                        <h3 class="text-lg font-semibold mb-2">{{ $c['name'] }}</h3>
                        <p class="text-gray-500 text-sm mb-3">{{ $c['desc'] }}</p>
                        <a href="#daftar" class="text-green-600 text-sm font-medium hover:underline">
                            Booking kelas &rarr;
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Pelatih --}}
    <section id="pelatih" class="py-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold">Pelatih Bersertifikat</h2>
            <p class="text-gray-500 mt-2">Pendampingan profesional untuk hasil maksimal.</p>

            @php
                $coaches = [
                    ['name' => 'Adit', 'role' => 'Strength & Conditioning'],
                    ['name' => 'Maya', 'role' => 'Mobility & Yoga'],
                    ['name' => 'Raka', 'role' => 'HIIT Specialist'],
                ];
            @endphp

            <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6 mt-10">
                @foreach ($coaches as $coach)
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1594385208976-0d7b8afd33a3?q=80&w=800&auto=format&fit=crop"
                            alt="Pelatih {{ $coach['name'] }}" class="w-full h-60 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $coach['name'] }}</h3>
                            <p class="text-gray-500 text-sm">{{ $coach['role'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Harga --}}
    <section id="harga" class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold">Paket Harga</h2>
            <p class="text-gray-500 mt-2">Sederhana dan transparan—pilih sesuai kebutuhan.</p>

            <div class="grid md:grid-cols-3 gap-6 mt-8">
                @forelse ($membershipPlans as $p)
                    <div class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                        {{-- Nama plan --}}
                        <h3 class="text-green-600 font-bold text-xl">{{ $p->nama_plan }}</h3>

                        {{-- Harga --}}
                        <p class="text-2xl font-bold mt-1 mb-3">
                            Rp {{ number_format($p->harga, 0, ',', '.') }} / {{ $p->periode_bulan }} bulan
                        </p>

                        {{-- Deskripsi --}}
                        <p class="text-gray-500 text-sm mb-4">
                            {{ $p->deskripsi }}
                        </p>

                        <a href="{{ route('membership.checkout', $p->plan_id) }}"
                            class="block w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
                            Pilih Paket
                        </a>
                    </div>
                @empty
                    <p class="col-span-3 text-gray-500">Belum ada paket tersedia</p>
                @endforelse
            </div>
        </div>
    </section>


    {{-- CTA --}}
    <section id="daftar" class="py-20">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-green-50 rounded-2xl shadow text-center py-12 px-6">
                <h2 class="text-3xl font-bold text-gray-900">Siap Mulai Perubahan?</h2>
                <p class="text-gray-500 mt-3 mb-6">Daftar sekarang dan nikmati kelas gratis pertama Anda.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-3">
                    <a href="#"
                        class="px-6 py-3 bg-green-600 text-white rounded-lg text-lg font-semibold hover:bg-green-700 transition">Daftar
                        Sekarang</a>
                    <a href="#"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg text-lg font-semibold hover:border-green-600 hover:text-green-600 transition">Tanya
                        Tim Kami</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('landing_page.layouts.app')

@section('title', 'Fitur Unggulan')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-black pt-32 overflow-hidden">
        <div class="max-w-7xl mx-auto relative">
            <div class="flex flex-col text-left mb-8">
                <h1 class="text-left text-5xl md:text-6xl font-poppins text-white mb-6">
                    Fitur Unggulan Kami
                </h1>
                <p class="text-neutral-400 text-lg max-w-3xl">
                    Fasilitas modern, teknologi canggih, dan pengalaman workout yang tak terlupakan. Semua dirancang untuk membawa performa Anda ke level selanjutnya.
                </p>
            </div>
        </div>
    </div>

    <!-- Features Grid Section -->
    <div class="relative bg-black py-8">
        <div class="max-w-7xl mx-auto">
            @php
            $features = [
                [
                    'title' => 'Area Functional & Strength',
                    'desc' => 'Ruang latihan luas dengan peralatan lengkap untuk beban bebas, rack profesional, dan berbagai latihan fungsional. Sempurna untuk membangun kekuatan dan massa otot.',
                    'icon' => 'fa-solid fa-dumbbell',
                    'highlight' => 'Premium Equipment'
                ],
                [
                    'title' => 'Cardio Theater',
                    'desc' => 'Treadmill modern dengan layar entertainment, stationary bike, rowing machine, dan elliptical untuk sesi kardio yang tidak membosankan dan bervariasi.',
                    'icon' => 'fa-solid fa-heart-pulse',
                    'highlight' => 'Modern Tech'
                ],
                [
                    'title' => 'Kelas Harian Bervariasi',
                    'desc' => 'Pilihan kelas yang beragam setiap hari: HIIT untuk bakar kalori maksimal, Yoga untuk fleksibilitas, Strength Training, dan Mobility untuk pemulihan optimal.',
                    'icon' => 'fa-solid fa-people-group',
                    'highlight' => 'Expert Instructors'
                ],
                [
                    'title' => 'Aplikasi Booking',
                    'desc' => 'Sistem booking online yang mudah digunakan. Pesan kelas favorit, jadwalkan konsultasi dengan pelatih, dan track progress Anda langsung dari smartphone.',
                    'icon' => 'fa-solid fa-mobile-screen-button',
                    'highlight' => 'Easy Access'
                ],
                [
                    'title' => 'Loker & Shower Premium',
                    'desc' => 'Fasilitas loker pribadi yang aman dan shower dengan air panas/dingin. Dilengkapi dengan area grooming untuk kenyamanan maksimal setelah workout.',
                    'icon' => 'fa-solid fa-shower',
                    'highlight' => 'Comfort First'
                ],
                [
                    'title' => 'Community Events',
                    'desc' => 'Bergabung dengan komunitas fitness yang suportif. Event bulanan, challenge bersama, dan networking session untuk membuat perjalanan fitness Anda lebih menyenangkan.',
                    'icon' => 'fa-solid fa-handshake-angle',
                    'highlight' => 'Strong Community'
                ],
            ];
            @endphp

            <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-8">
                @foreach ($features as $f)
                <div class="group bg-neutral-900 p-8 rounded-2xl border border-neutral-800 hover:border-[#ADFF2F]/50 transition-all duration-300 hover:-translate-y-2">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 flex items-center justify-center rounded-xl bg-neutral-800 text-[#ADFF2F] text-xl group-hover:bg-[#ADFF2F] group-hover:text-black transition-all duration-300">
                            <i class="{{ $f['icon'] }}" aria-hidden="true"></i>
                        </div>
                    </div>
                    <h3 class="text-xl font-poppins font-semibold text-white mb-3">{{ $f['title'] }}</h3>
                    <p class="text-neutral-400 text-sm leading-relaxed">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
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
                    <a href="{{ route('home') }}#pricing" class="bg-[#ADFF2F] text-black px-8 py-3 rounded-full font-medium hover:bg-[#9DE625] transition-all duration-300 hover:scale-105">
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

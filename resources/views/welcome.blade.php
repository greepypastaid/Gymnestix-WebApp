@extends('landing_page.layouts.app')

@section('title', 'Gymnestix - Bangun Versi Terkuatmu')
@section('meta_description',
    'Gym modern dengan fasilitas lengkap, kelas beragam, dan pelatih bersertifikat. Coba kelas
    gratis hari ini!')

@section('content')
    {{-- Hero --}}
    @include('landing_page.hero') 

    {{-- Fitur --}}
    @include('landing_page.fitur') 

    {{-- Class --}}
    @include('landing_page.class_option')

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

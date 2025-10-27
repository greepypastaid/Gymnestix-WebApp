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

    {{-- Harga --}}
    @include('landing_page.price_option')

    {{-- CTA --}}
    @include('landing_page.cta')
    
@endsection

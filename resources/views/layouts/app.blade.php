<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  {{-- Bootstrap CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  {{-- Bootstrap Icons (PASTIKAN di dalam <head>) --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  {{-- Vite (kalau dipakai proyeknya) --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    .table td,.table th{vertical-align:middle}
    .table thead th{font-weight:600;letter-spacing:.2px}
  </style>
</head>
<body class="font-sans antialiased bg-light">
  <div class="min-h-screen">
    {{-- SEMENTARA matikan baris di bawah untuk memastikan bukan penyebab blank --}}
    {{-- @include('layouts.navigation') --}}
    <main>@yield('content')</main>
  </div>

  <script defer src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js"></script>
</body>
</html>

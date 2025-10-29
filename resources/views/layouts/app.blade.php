<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons (PASTIKAN di dalam <head>) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Load Nunito + Inter + Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    {{-- Buat demo aktifin dibawah ini --}}
    {{-- Tailwind CDN (dev/testing only). For custom theme colors below. --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'gymnestix': '#ADFF2F',
                        'gymnestix-hover': '#9DE626',
                        'gymnestix-dark': '#1a1a1a',
                        'gymnestix-gray': '#2a2a2a',
                        'gymnestix-light-gray': '#3a3a3a',
                    }
                }
            }
        }
    </script>

    <!-- Buat Local & Prod-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom Gymnestix Theme */
        :root {
            --gymnestix-primary: #ADFF2F;
            --gymnestix-primary-hover: #9DE626;
            --gymnestix-dark: #1a1a1a;
            --gymnestix-gray: #2a2a2a;
            --gymnestix-light-gray: #3a3a3a;
        }

        body {
            font-family: 'Inter', 'Nunito', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            background-color: var(--gymnestix-dark) !important;
            color: #ffffff;
        }

        .gymnestix-bg-dark { background-color: var(--gymnestix-dark) !important; }
        .gymnestix-bg-gray { background-color: var(--gymnestix-gray) !important; }
        .gymnestix-bg-light-gray { background-color: var(--gymnestix-light-gray) !important; }
        .gymnestix-primary { color: var(--gymnestix-primary) !important; }
        .gymnestix-bg-primary { background-color: var(--gymnestix-primary) !important; color: #000000 !important; }
        .gymnestix-btn-primary { 
            background-color: var(--gymnestix-primary) !important; 
            border-color: var(--gymnestix-primary) !important; 
            color: #000000 !important; 
        }
        .gymnestix-btn-primary:hover { 
            background-color: var(--gymnestix-primary-hover) !important; 
            border-color: var(--gymnestix-primary-hover) !important; 
        }

        /* Override Bootstrap dark theme */
        .card { 
            background-color: var(--gymnestix-gray) !important; 
            border: 1px solid var(--gymnestix-light-gray) !important; 
            color: #ffffff !important;
        }
        .table { 
            --bs-table-bg: var(--gymnestix-gray);
            --bs-table-color: #ffffff;
        }
        .table th, .table td { 
            border-color: var(--gymnestix-light-gray) !important; 
            color: #ffffff !important;
        }
        .table thead th { 
            background-color: var(--gymnestix-light-gray) !important;
            border-color: var(--gymnestix-primary) !important;
            color: var(--gymnestix-primary) !important;
            font-weight: 600;
            letter-spacing: .2px;
        }

        .btn-outline-primary {
            color: var(--gymnestix-primary) !important;
            border-color: var(--gymnestix-primary) !important;
        }
        .btn-outline-primary:hover {
            background-color: var(--gymnestix-primary) !important;
            border-color: var(--gymnestix-primary) !important;
            color: #000000 !important;
        }

        .form-control, .form-select {
            background-color: var(--gymnestix-light-gray) !important;
            border-color: var(--gymnestix-primary) !important;
            color: #ffffff !important;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--gymnestix-primary-hover) !important;
            box-shadow: 0 0 0 0.25rem rgba(173, 255, 47, 0.25) !important;
        }

        .alert-success {
            background-color: rgba(173, 255, 47, 0.1) !important;
            border-color: var(--gymnestix-primary) !important;
            color: var(--gymnestix-primary) !important;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .table thead th {
            font-weight: 600;
            letter-spacing: .2px;
        }
    </style>
</head>

<body class="font-sans antialiased bg-black text-white"> 
    <div class="min-h-screen bg-black"> 
        @include('layouts.navigation')
        <main class="md:ml-64 pt-16">
            @isset($slot)
            {{ $slot }}
            @endisset

            @yield('content')
        </main>
    </div>
    {{-- sebelum tag penutup body --}}
    <script defer src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard')</title>
    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'gymnestix': '#ADFF2F',
                        'gymnestix-hover': '#9DE626',
                        'gymnestix-dark': '#0a0a0a',
                        'gymnestix-gray': '#141414',
                        'gymnestix-light-gray': '#1f1f1f',
                    }
                }
            }
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Minimalist Dark Theme */
        :root {
            --primary: #ADFF2F;
            --primary-hover: #9DE626;
            --bg-dark: #0a0a0a;
            --bg-card: #141414;
            --bg-hover: #1f1f1f;
            --border: #2a2a2a;
            --text-primary: #ffffff;
            --text-secondary: #a0a0a0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-dark);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--bg-hover);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--border);
        }

        /* Custom Classes */
        .card-dark {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .card-dark:hover {
            border-color: var(--primary);
        }

        .btn-primary-custom {
            background: var(--primary);
            color: #000;
            font-weight: 600;
            padding: 0.625rem 1.25rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary-custom:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: var(--bg-hover);
            color: var(--text-primary);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-secondary:hover {
            background: rgba(255,255,255,0.02);
            transform: translateY(-1px);
        }

        .input-dark {
            background: var(--bg-hover);
            border: 1px solid var(--border);
            color: var(--text-primary);
            border-radius: 8px;
            padding: 0.625rem 1rem;
            transition: all 0.2s ease;
        }

        .input-dark:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(173, 255, 47, 0.1);
        }

        .badge-custom {
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Header card used across trainer pages */
        .card-header {
            background: var(--bg-hover);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .card-header .title {
            font-size: 1.5rem; /* larger title */
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.1;
        }

        .card-header .subtitle {
            color: var(--text-secondary);
            font-size: 1.05rem; /* slightly larger subtitle */
            margin-top: 2px;
        }

        /* Minimal table variant used for index lists */
        .table-minimal {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: var(--bg-card);
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .table-minimal thead th {
            background: var(--bg-hover);
            color: var(--text-secondary);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.75rem 1rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }

        .table-minimal tbody tr {
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }

        .table-minimal td {
            padding: 0.75rem 1rem;
            color: var(--text-primary);
            font-size: 0.95rem;
            vertical-align: middle;
        }

        .table-minimal .muted { color: var(--text-secondary); font-size: 0.88rem; }
    </style>
</head>

<body class="font-sans antialiased"> 
    <div class="min-h-screen bg-[#0a0a0a]"> 
        @include('layouts.navigation')
        <main class="pt-16 md:ml-64 min-h-screen">
            @isset($slot)
            {{ $slot }}
            @endisset

            @yield('content')
        </main>
    </div>
    <script defer src="https://unpkg.com/alpinejs@3.12.0/dist/cdn.min.js"></script>
</body>

</html>
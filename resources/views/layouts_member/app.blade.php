<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Gymnestix - Bangun Versi Terkuatmu')</title>
    <meta name="description" content="@yield('meta_description', 'Gym modern dengan fasilitas lengkap, kelas bervariasi, dan pelatih bersertifikat untuk membantu Anda mencapai tujuan kebugaran.')" />

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap"
        rel="stylesheet">

    {{-- ✅ Tailwind via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Optional: custom theme colors --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#059669', // emerald-600
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                        heading: ['Poppins', 'ui-sans-serif', 'system-ui'],
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-white text-gray-900 font-sans">
    {{-- Skip to content --}}
    <a href="#utama"
        class="absolute left-[-999px] focus:left-4 focus:top-4 bg-white text-gray-800 px-4 py-2 rounded shadow z-50">
        Lewati ke konten utama
    </a>

    {{-- ✅ Navbar Tailwind --}}
    @include('partials_member.navbar')

    {{-- Main Content --}}
    <main id="utama" class="pt-20 min-h-screen">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-50 border-t mt-10">
        <div
            class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center gap-3 text-sm text-gray-600">
            <p>© {{ date('Y') }} <strong>Gymnestix</strong>. Semua hak dilindungi.</p>
            <nav class="flex gap-4">
                <a href="#" class="hover:text-primary">Kebijakan Privasi</a>
                <a href="#" class="hover:text-primary">Syarat & Ketentuan</a>
                <a href="#" class="hover:text-primary">Kontak</a>
            </nav>
        </div>
    </footer>

    {{-- Alpine.js for dropdown --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>

</html>

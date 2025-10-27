<div class="relative min-h-screen text-white overflow-hidden">
    <div class="absolute h-screen w-full">
        <img src="{{ asset('storage/heroImage.jpg') }}" alt="Hero background" class="w-full h-screen object-cover">
        {{-- subtle overlay so text is readable; adjust opacity as needed --}}
        <div class="absolute inset-0 bg-black/40"></div>
    </div>
    <div class="relative z-10 min-h-screen flex items-center">
        <div class="max-w-7xl w-full mx-auto item-left">
            <!-- Hero Section -->
            <div class="max-w-3xl">
                <h1 class="text-7xl font-nunito text-white leading-tight">
                    Bangun Dirimu di Gymnestix
                </h1>
                <p class="mt-6 text-neutral-300 font-poppins text-lg">
                    Fasilitas premium, kelas bervariasi, dan pelatih bersertifikat siap membantu Anda mencapai tujuan
                    kebugaran — dari pemula hingga atlet.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 mt-24">
                    <a href="#daftar"
                        class="px-6 py-3 bg-[#ADFF2F] rounded-lg text-lg text-black font-poppins hover:bg-[#ADFF2F] transition">
                        Coba Kelas Gratis
                    </a>
                    <a href="#fitur"
                        class="px-6 py-3 border border-gray-300 text-white rounded-lg text-lg font-poppins hover:border-[#ADFF2F] hover:text-[#ADFF2F] transition">
                        Lihat Fitur
                    </a>
                </div>
                <div class="max-w-sm grid grid-cols-2 gap-3 mt-12 text-white text-sm">
                    <div class="flex items-center gap-2"><i class="bi bi-clock text-yellow-500"></i> 24/7 Akses</div>
                    <div class="flex items-center gap-2"><i class="bi bi-person-check text-yellow-500"></i> Pelatih
                        Bersertifikat</div>
                    <div class="flex items-center gap-2"><i class="bi bi-calendar-check text-yellow-500"></i> Kelas Harian
                    </div>
                    <div class="flex items-center gap-2"><i class="bi bi-trophy text-yellow-500"></i> Peralatan Premium
                    </div>
                </div>
            </div>

        </div>
    </div>
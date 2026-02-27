<div class="relative md:min-h-screen text-white overflow-hidden">
    <div class="absolute h-screen w-full">
        <img src="{{ asset('images/Hero.png') }}" alt="Hero background" class="w-full h-screen object-cover">
        {{-- subtle overlay so text is readable; adjust opacity as needed --}}
        <div class="absolute inset-0"></div>
    </div>
    <div class="relative z-10 min-h-screen flex items-center">
        <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 item-left">
            <!-- Hero Section -->
            <div class="w-9/10 md:max-w-3xl lg:max-w-3xl xl:max-w-4xl">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-nunito text-white leading-tight">
                    Kembangkan Dirimu di Gymnestix
                </h1>
                <p class="mt-4 sm:mt-6 text-neutral-300 font-poppins text-sm md:text-base sm:max-w-md md:max-w-lg lg:max-w-xl">
                    Fasilitas premium, kelas bervariasi, dan pelatih bersertifikat siap membantu Anda mencapai tujuan
                    kebugaran — dari pemula hingga atlet.
                </p>
                <div class="flex sm:flex-row gap-3 mt-24 md:mt-16">
                    <a href="#daftar"
                        class="px-5 sm:px-6 py-3 bg-[#ADFF2F] rounded-lg text-sm sm:text-base lg:text-lg text-black font-poppins hover:bg-[#ADFF2F] transition">
                        Coba Kelas Gratis
                    </a>
                    <a href="#fitur"
                        class="px-5 sm:px-6 py-3 border border-gray-300 text-white rounded-lg text-sm sm:text-base lg:text-lg font-poppins hover:border-[#ADFF2F] hover:text-[#ADFF2F] transition">
                        Lihat Fitur
                    </a>
                </div>
                <div class="max-w-sm gap-2 sm:max-w-md sm:gap-3 grid grid-cols-2 mt-8 sm:mt-12 text-white text-xs sm:text-sm">
                    <div class="items-center"><i class="bi bi-clock text-yellow-500"></i> 24/7 Akses</div>
                    <div class="items-center"><i class="bi bi-person-check text-yellow-500"></i> Pelatih
                        Bersertifikat</div>
                    <div class="items-center"><i class="bi bi-calendar-check text-yellow-500"></i> Kelas Harian
                    </div>
                    <div class="items-center"><i class="bi bi-trophy text-yellow-500"></i> Peralatan Premium
                    </div>
                </div>
            </div>
        </div>
    </div>
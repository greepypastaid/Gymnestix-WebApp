<nav id="site-navbar" class="fixed w-full top-0 z-50 px-2 bg-black md:bg-transparent transition-colors duration-300 ease-in-out">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between h-16 items-center">
            {{-- Logo --}}
            {{-- 🌿 Navbar (Tema Hijau Modern) --}}
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <div class="w-12 h-12 rounded-md flex items-center justify-center shadow-md">
                        <img src="{{ asset('images/GymnestixLogo.png') }}" alt="Gymnestix"
                            class="object-cover w-10 h-10 filter saturate-0 brightness-200 group-hover:saturate-100 group-hover:brightness-100 group-hover:scale-105 transition-all duration-300 ease-in-out" />
                    </div>
                    <span
                        class="font-bold text-lg text-white group-hover:text-[#ADFF2F] transition-colors duration-300">
                        Gymnestix
                    </span>
                </a>
            </div>

            {{-- 🌱 Menu Desktop --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('features') }}"
                    class="relative text-white hover:text-[#ADFF2F] font-medium transition">
                    Fitur
                    <span
                        class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-[#ADFF2F] transition-all duration-300 hover:w-full"></span>
                </a>
                <a href="{{ route('classes.index') }}"
                    class="relative text-white hover:text-[#ADFF2F] font-medium transition">
                    Kelas
                    <span
                        class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-[#ADFF2F] transition-all duration-300 hover:w-full"></span>
                </a>
                <a href="{{ route('trainers.index') }}"
                    class="relative text-white hover:text-[#ADFF2F] font-medium transition">
                    Pelatih
                    <span
                        class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-[#ADFF2F] transition-all duration-300 hover:w-full"></span>
                </a>
                <a href="{{ route('pricing') }}"
                    class="relative text-white hover:text-[#ADFF2F] font-medium transition">
                    Harga
                    <span
                        class="absolute left-0 bottom-[-4px] w-0 h-[2px] bg-[#ADFF2F] transition-all duration-300 hover:w-full"></span>
                </a>
            </div>


            {{-- Auth Buttons / Profile --}}
            {{-- 🌿 Bagian Kanan Navbar (Auth Buttons / Profil) --}}
            <div class="hidden md:flex items-center gap-6">
                @auth
                {{-- Dropdown Profil (klik toggle) --}}
                <p class="text-white font-sans font-medium">Welcome back!</p>
                <div class="relative">
                    <button id="profile-dropdown-btn"
                        class="flex items-center gap-2 text-white hover:text-[#ADFF2F] focus:outline-none transition font-medium">
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile" class="w-10 h-10 object-cover rounded-full" />
                        <span>{{ Auth::user()->name }}</span>
                        <i class="bi bi-chevron-down text-gray-500 hover:text-[#ADFF2F] text-sm"></i>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div id="profile-dropdown-menu"
                        class="absolute right-0 mt-3 w-52 bg-neutral-900 rounded-xl shadow-lg hidden z-50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role->name ?? 'guest' }}
                                {{ Auth::user()->member->membershipPlan->nama_plan ?? '' }} Gymnestix
                            </p>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2.5 text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition">
                            <i class="bi bi-person-circle mr-2 text-[#ADFF2F]"></i> Profil
                        </a>
                        <a href="{{ route('member.payment.history') }}"
                            class="block px-4 py-2.5 text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition">
                            <i class="bi bi-cash mr-2 text-[#ADFF2F]"></i> Pembayaran
                        </a>
                        @if (Auth::user()->isAdmin() || Auth::user()->isTrainer())
                        <a href="{{ route('dashboard') }}"
                            class="block px-4 py-2.5 text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition">
                            <i class="bi bi-speedometer2 mr-2 text-[#ADFF2F]"></i> Dashboard
                        </a>
                        @endif
                        @if (Auth::user()->isMember())
                        <a href="{{ route('member.classes.index') }}"
                            class="block px-4 py-2.5 text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition">
                            <i class="bi bi-clipboard mr-2 text-[#ADFF2F]"></i> Kelasku
                        </a>
                        <a href="{{ route('member.classes.jadwalku') }}"
                            class="block px-4 py-2.5 text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition">
                            <i class="bi bi-calendar mr-2 text-[#ADFF2F]"></i> Jadwalku
                        </a>

                        <a href="#"
                            class="block px-4 py-2.5 text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition">
                            <i class="bi bi-bell mr-2 text-[#ADFF2F]"></i> Absensi
                        </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2.5 text-white hover:bg-red-50 hover:text-red-600 transition">
                                <i class="bi bi-box-arrow-right mr-2 text-red-500"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
                @else
                {{-- Tombol Auth --}}
                <a href="{{ route('login') }}" class="text-white hover:text-[#ADFF2F] font-medium transition">Masuk</a>
                <a href="{{ route('register') }}"
                    class="bg-[#ADFF2F] text-black px-4 py-2 rounded-lg font-medium shadow hover:shadow-lg hover:bg-[#9DE626] transition-all">
                    Daftar
                </a>
                @endauth
            </div>


            {{-- Mobile Toggle --}}
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- 🌿 Mobile Menu (Hijau, Modern & Fresh) --}}
        <div id="mobile-menu"
            class="md:hidden hidden border-t border-gray-800 bg-black/0 shadow-lg transition-all duration-300 ease-in-out overflow-hidden rounded-b-2xl">
            <div class="px-5 py-5 space-y-4">
                {{-- 🔗 Navigasi Utama --}}
                <div class="flex flex-col gap-3">
                    <a href="{{ route('features') }}"
                        class="flex items-center gap-2 text-white hover:text-[#ADFF2F] font-medium transition-colors">
                        <i class="bi bi-lightning-charge-fill text-green-500"></i>
                        Fitur
                    </a>
                    <a href="{{ route('classes.index') }}"
                        class="flex items-center gap-2 text-white hover:text-[#ADFF2F] font-medium transition-colors">
                        <i class="bi bi-collection-play-fill text-green-500"></i>
                        Kelas
                    </a>
                    <a href="{{ route('trainers.index') }}"
                        class="flex items-center gap-2 text-white hover:text-[#ADFF2F] font-medium transition-colors">
                        <i class="bi bi-person-badge-fill text-green-500"></i>
                        Pelatih
                    </a>
                    <a href="{{ route('pricing') }}"
                        class="flex items-center gap-2 text-white hover:text-[#ADFF2F] font-medium transition-colors">
                        <i class="bi bi-cash-stack text-green-500"></i>
                        Harga
                    </a>
                </div>

                <hr class="border-gray-200 my-4">

                {{-- 👤 Bagian Auth --}}
                @auth
                <div class="flex items-center gap-3 border-b pb-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" alt="Avatar"
                        class="w-10 h-10 rounded-full border border-green-400" />
                    <div>
                        <p class="text-gray-800 font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500">Member</p>
                    </div>
                </div>

                <div class="flex flex-col gap-2 mt-3">
                    <a href="{{ route('profile.edit') }}"
                        class="flex items-center gap-2 text-white hover:text-[#ADFF2F] transition-colors">
                        <i class="bi bi-person-circle text-green-500"></i> Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 text-white hover:text-red-600 transition-colors">
                            <i class="bi bi-box-arrow-right text-red-500"></i> Keluar
                        </button>
                    </form>
                </div>
                @else
                <div class="flex flex-col gap-2">
                    <a href="{{ route('login') }}"
                        class="flex items-center justify-center gap-2 border border-[#ADFF2F] text-[#ADFF2F] rounded-md py-2 font-medium hover:bg-neutral-700 transition">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="flex items-center justify-center gap-2 bg-[#ADFF2F] text-black rounded-md py-2 font-medium hover:bg-[#9DE626] transition">
                        <i class="bi bi-person-plus"></i> Daftar
                    </a>
                </div>
                @endauth
            </div>
        </div>

    </div>
</nav>

{{-- Script toggle mobile menu + navbar transparency responsive --}}
@push('scripts')
<script defer>
document.addEventListener('DOMContentLoaded', function () {
    const profileBtn = document.getElementById('profile-dropdown-btn');
    const dropdownMenu = document.getElementById('profile-dropdown-menu');

    profileBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle('hidden');
    });

    // Tutup dropdown kalau klik di luar
    document.addEventListener('click', (e) => {
        if (profileBtn && dropdownMenu) {
            if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        }
    });

    // Mobile menu toggle
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');

    if (btn && menu) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            menu.classList.toggle('max-h-0');
            menu.classList.toggle('max-h-[500px]');
        });
    }

    // Navbar transparency logic:
    const navbar = document.getElementById('site-navbar');
    const SCROLL_THRESHOLD = 30; // pixel threshold untuk berubah
    const DESKTOP_BREAKPOINT = 768; // md: 768px

    function isDesktop() {
        return window.innerWidth >= DESKTOP_BREAKPOINT;
    }

    function applySolid() {
        if (!navbar) return;
        // Solid background (full black) + shadow + blur for readability
        navbar.classList.add('bg-black', 'bg-opacity-100', 'shadow-md', 'backdrop-blur-sm');
        // Remove any "transparent" variants
        navbar.classList.remove('bg-transparent', 'bg-black/10', 'bg-opacity-10');
        // Mobile menu should be solid on mobile or when navbar is solid
        if (menu) {
            menu.classList.add('bg-black', 'bg-opacity-100');
            menu.classList.remove('bg-black/0');
        }
    }

    function applyTransparent() {
        if (!navbar) return;
        navbar.classList.remove('bg-black', 'bg-opacity-100', 'shadow-md');
        navbar.classList.add('bg-black', 'backdrop-blur-lg');

        if (menu) {
            menu.classList.remove('bg-black', 'bg-opacity-100');
            menu.classList.add('bg-black/100');
        }
    }

    function updateNavbarState() {
        if (!navbar) return;

        if (!isDesktop()) {
            applySolid();
            return;
        }

        if (window.scrollY > SCROLL_THRESHOLD) {
            applySolid();
        } else {
            applyTransparent();
        }
    }

    updateNavbarState();
    window.addEventListener('scroll', updateNavbarState, { passive: true });

    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            updateNavbarState();
        }, 120);
    });
});
</script>
@endpush
<!-- Top Navigation Bar -->
<nav class="bg-black border-b border-neutral-700 fixed top-0 left-0 right-0 z-50">
    <div class="mx-auto px-6 sm:px-6 lg:px-12">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Sidebar Toggle Button -->
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-neutral-400 hover:text-white hover:bg-neutral-700 focus:outline-none focus:bg-neutral-700 focus:text-white transition duration-150 ease-in-out mr-4">
                    <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': sidebarOpen, 'inline-flex': !sidebarOpen}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !sidebarOpen, 'inline-flex': sidebarOpen}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 rounded-md flex items-center justify-center shadow-md">
                            <img src="{{ asset('images/GymnestixLogo.png') }}" alt="Gymnestix"
                                class="object-cover w-8 h-8 filter saturate-0 brightness-200 group-hover:saturate-100 group-hover:brightness-100 group-hover:scale-105 transition-all duration-300 ease-in-out" />
                        </div>
                        <span class="font-bold text-lg text-white hovergroup:text-[#ADFF2F] transition-colors duration-300">
                            Gymnestix
                        </span>
                    </a>
                </div>
            </div>

            <!-- User Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-white bg-neutral-700 hover:bg-neutral-600 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile User Menu Toggle -->
            <div class="sm:hidden flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center justify-center p-2 rounded-md text-neutral-400 hover:text-white hover:bg-neutral-700 focus:outline-none focus:bg-neutral-700 focus:text-white transition duration-150 ease-in-out">
                            <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-neutral-700">
                            <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-neutral-400">{{ Auth::user()->email }}</div>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div x-data="{ sidebarOpen: false }" class="fixed inset-y-12 left-0 z-40 w-64 bg-neutral-900 border-r border-neutral-700 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out pt-16 md:pt-0">
    <div class="flex flex-col h-full">
        <!-- Sidebar Header (for mobile close button) -->
        <div class="md:hidden flex items-center justify-between p-4 border-b border-neutral-700">
            <span class="text-white font-semibold">Menu</span>
            <button @click="sidebarOpen = false" class="text-neutral-400 hover:text-white">
                <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 px-6 py-6 space-y-2">
            <h1 class="px-4 my-2 text-3xl font-bold font-poppins">Sidebar</h1>
            <hr class="mx-4 border border-neutral-100 mb-4">

            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-md font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-[#ADFF2F] text-black' : 'text-white hover:bg-neutral-700 hover:text-[#ADFF2F]' }} transition duration-150">
                <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z" />
                </svg>
                Dashboard
            </a>

            <!-- Add more navigation links here based on user role -->
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.index') }}" class="flex items-center px-4 py-2 text-md font-medium rounded-md text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition duration-150">
                <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                Manage Users
            </a>
            <a href="{{ route('membership_plan.index') }}" class="flex items-center px-4 py-2 text-md font-medium rounded-md text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition duration-150">
                <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Membership Plans
            </a>
            <a href="{{ route('gym_class.index') }}" class="flex items-center px-4 py-2 text-md font-medium rounded-md text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition duration-150">
                <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Class Schedule
            </a>
            <a href="{{ route('billing.index') }}" class="flex items-center px-4 py-2 text-md font-medium rounded-md text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition duration-150">
                <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Billing & Payments
            </a>
            @elseif(auth()->user()->isTrainer())
            <a href="{{ route('trainer.classes.index') }}" class="flex items-center px-4 py-2 text-md font-medium rounded-md text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition duration-150">
                <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                My Classes
            </a>
            <a href="{{ route('trainer.equipments.index') }}" class="flex items-center px-4 py-2 text-md font-medium rounded-md text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition duration-150">
                <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Equipment Status
            </a>
            <a href="{{ route('trainer.attendance.select-class') }}" class="flex items-center px-4 py-2 text-md font-medium rounded-md text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition duration-150">
                <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                Attendance
            </a>
            <a href="{{ route('trainer.attendance.view_all') }}" class="flex items-center px-4 py-2 text-md font-medium rounded-md text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition duration-150">
                <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                View Attendance
            </a>
            <a href="#" onclick="showMemberSelector()" class="flex items-center px-4 py-2 text-md font-medium rounded-md text-white hover:bg-neutral-700 hover:text-[#ADFF2F] transition duration-150">
                <svg class="mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Workout Tracker
            </a>
            @endif
        </div>
    </div>
</div>

<!-- Mobile Sidebar Overlay -->
<div x-show="sidebarOpen" @click="sidebarOpen = false" class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-30" x-transition></div>
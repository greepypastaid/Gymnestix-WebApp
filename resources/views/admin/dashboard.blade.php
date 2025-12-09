@extends('layouts.app')

@section('content')
<div class="py-6 sm:py-12 bg-black min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4 sm:space-y-8">
        <!-- Welcome Section -->
        <div class="bg-gradient-to-r from-neutral-800 to-neutral-900 rounded-lg sm:rounded-2xl p-4 sm:p-8 shadow-2xl border border-neutral-700">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-xl sm:text-3xl font-bold text-white mb-1 sm:mb-2">Welcome back, {{ auth()->user()->nama }}!</h1>
                    <p class="text-xs sm:text-base text-neutral-400">Manage your gym operations from this dashboard</p>
                </div>
                <div class="w-10 h-10 sm:w-16 sm:h-16 rounded-lg sm:rounded-2xl flex items-center justify-center" style="background: rgba(173,255,47,0.1);">
                    <svg class="w-5 h-5 sm:w-8 sm:h-8" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Quick Access Cards -->
        <div>
            <h2 class="text-lg sm:text-2xl font-bold text-white mb-3 sm:mb-4">Quick Access</h2>
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                <!-- User & Member Card -->
                <a href="{{ route('admin.index') }}" class="group">
                    <div class="bg-neutral-800 rounded-lg sm:rounded-2xl p-3 sm:p-6 shadow-xl border border-neutral-700 hover:border-[#ADFF2F] transition-all duration-200 h-full hover:shadow-2xl">
                        <div class="w-8 h-8 sm:w-14 sm:h-14 rounded-lg sm:rounded-xl flex items-center justify-center mb-2 sm:mb-4" style="background: rgba(173,255,47,0.1);">
                            <svg class="w-4 h-4 sm:w-7 sm:h-7" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm sm:text-lg font-semibold text-white mb-1 sm:mb-2">User & Member</h3>
                        <p class="text-xs sm:text-sm text-neutral-400 mb-2 sm:mb-4 hidden sm:block">Manage users and members</p>
                        <div class="flex items-center text-[#ADFF2F] text-xs sm:text-sm font-medium group-hover:translate-x-1 transition-transform">
                            Kelola User
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Membership Plan Card -->
                <a href="{{ route('membership_plan.index') }}" class="group">
                    <div class="bg-neutral-800 rounded-lg sm:rounded-2xl p-3 sm:p-6 shadow-xl border border-neutral-700 hover:border-[#ADFF2F] transition-all duration-200 h-full hover:shadow-2xl">
                        <div class="w-8 h-8 sm:w-14 sm:h-14 rounded-lg sm:rounded-xl flex items-center justify-center mb-2 sm:mb-4" style="background: rgba(173,255,47,0.1);">
                            <svg class="w-4 h-4 sm:w-7 sm:h-7" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm sm:text-lg font-semibold text-white mb-1 sm:mb-2">Membership Plan</h3>
                        <p class="text-xs sm:text-sm text-neutral-400 mb-2 sm:mb-4 hidden sm:block">Configure membership plans</p>
                        <div class="flex items-center text-[#ADFF2F] text-xs sm:text-sm font-medium group-hover:translate-x-1 transition-transform">
                            Kelola Plan
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Schedule Card -->
                <a href="{{ route('gym_class.index') }}" class="group">
                    <div class="bg-neutral-800 rounded-2xl p-6 shadow-xl border border-neutral-700 hover:border-[#ADFF2F] transition-all duration-200 h-full hover:shadow-2xl">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4" style="background: rgba(173,255,47,0.1);">
                            <svg class="w-7 h-7" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Jadwal Kelas/Gym</h3>
                        <p class="text-sm text-neutral-400 mb-4">Manage class schedules</p>
                        <div class="flex items-center text-[#ADFF2F] text-sm font-medium group-hover:translate-x-1 transition-transform">
                            Kelola Jadwal
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Payment Card -->
                <a href="{{ route('billing.index') }}" class="group">
                    <div class="bg-neutral-800 rounded-2xl p-6 shadow-xl border border-neutral-700 hover:border-[#ADFF2F] transition-all duration-200 h-full hover:shadow-2xl">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4" style="background: rgba(173,255,47,0.1);">
                            <svg class="w-7 h-7" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Pembayaran</h3>
                        <p class="text-sm text-neutral-400 mb-4">Handle payment transactions</p>
                        <div class="flex items-center text-[#ADFF2F] text-sm font-medium group-hover:translate-x-1 transition-transform">
                            Kelola Pembayaran
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Management Tools -->
        <div>
            <h2 class="text-lg sm:text-2xl font-bold text-white mb-3 sm:mb-4">Management Tools</h2>
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                @can('schedule.assign_trainer')
                <a href="{{ Route::has('admin.assignments.index') ? route('admin.assignments.index') : '#' }}" class="group">
                    <div class="bg-neutral-800 rounded-2xl p-6 shadow-xl border border-neutral-700 hover:border-[#ADFF2F] transition-all duration-200 h-full hover:shadow-2xl">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4" style="background: rgba(173,255,47,0.1);">
                            <svg class="w-7 h-7" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Jadwal & Assign Trainer</h3>
                        <p class="text-sm text-neutral-400 mb-4">Kelola jadwal kelas dan penugasan pelatih</p>
                        <div class="flex items-center text-[#ADFF2F] text-sm font-medium group-hover:translate-x-1 transition-transform">
                            Kelola Jadwal
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
                @endcan

                @can('attendance.track')
                <a href="{{ Route::has('admin.attendance.index') ? route('admin.attendance.index') : '#' }}" class="group">
                    <div class="bg-neutral-800 rounded-2xl p-6 shadow-xl border border-neutral-700 hover:border-[#ADFF2F] transition-all duration-200 h-full hover:shadow-2xl">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4" style="background: rgba(173,255,47,0.1);">
                            <svg class="w-7 h-7" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Attendance</h3>
                        <p class="text-sm text-neutral-400 mb-4">Catat & pantau kehadiran member</p>
                        <div class="flex items-center text-[#ADFF2F] text-sm font-medium group-hover:translate-x-1 transition-transform">
                            Kelola Attendance
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
                @endcan

                @canany(['equipment.manage','equipment.view_all'])
                <a href="{{ Route::has('admin.equipment.index') ? route('admin.equipment.index') : '#' }}" class="group">
                    <div class="bg-neutral-800 rounded-2xl p-6 shadow-xl border border-neutral-700 hover:border-[#ADFF2F] transition-all duration-200 h-full hover:shadow-2xl">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4" style="background: rgba(173,255,47,0.1);">
                            <svg class="w-7 h-7" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Equipment</h3>
                        <p class="text-sm text-neutral-400 mb-4">@can('equipment.manage') Kelola data & status alat gym @else Lihat seluruh alat gym @endcan</p>
                        <div class="flex items-center text-[#ADFF2F] text-sm font-medium group-hover:translate-x-1 transition-transform">
                            Buka Equipment
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
                @endcanany

                @can('workout.manage')
                <a href="{{ Route::has('admin.workouts.index') ? route('admin.workouts.index') : '#' }}" class="group">
                    <div class="bg-neutral-800 rounded-2xl p-6 shadow-xl border border-neutral-700 hover:border-[#ADFF2F] transition-all duration-200 h-full hover:shadow-2xl">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4" style="background: rgba(173,255,47,0.1);">
                            <svg class="w-7 h-7" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white mb-2">Workout Manager</h3>
                        <p class="text-sm text-neutral-400 mb-4">Template latihan & progress tracking</p>
                        <div class="flex items-center text-[#ADFF2F] text-sm font-medium group-hover:translate-x-1 transition-transform">
                            Kelola Workout
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
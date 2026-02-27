@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto space-y-6">
        <!-- Welcome Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white mb-1">Welcome back, {{ auth()->user()->nama }}</h1>
                <p class="text-gray-400 text-sm">Manage your gym operations efficiently</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-[#ADFF2F]/10 flex items-center justify-center">
                <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            <!-- Total Users -->
            <div class="card-dark p-6">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider">Total Users</span>
                </div>
                <div class="text-3xl font-bold text-white mb-1">{{ number_format($stats['total_users']) }}</div>
                <p class="text-sm text-gray-400">Registered accounts</p>
            </div>

            <!-- Active Members -->
            <div class="card-dark p-6">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider">Active Members</span>
                </div>
                <div class="text-3xl font-bold text-white mb-1">{{ number_format($stats['active_members']) }}</div>
                <p class="text-sm text-gray-400">With valid membership</p>
            </div>

            <!-- Total Classes -->
            <div class="card-dark p-6">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider">Total Classes</span>
                </div>
                <div class="text-3xl font-bold text-white mb-1">{{ number_format($stats['total_classes']) }}</div>
                <p class="text-sm text-gray-400">Available schedules</p>
            </div>

            <!-- Monthly Bookings -->
            <div class="card-dark p-6">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider">Monthly Bookings</span>
                </div>
                <div class="text-3xl font-bold text-white mb-1">{{ number_format($stats['monthly_bookings']) }}</div>
                <p class="text-sm text-gray-400">Class registrations</p>
            </div>

            <!-- Equipment Issues -->
            <div class="card-dark p-6">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider">Equipment Issues</span>
                </div>
                <div class="text-3xl font-bold text-white mb-1">{{ number_format($stats['equipment_issues']) }}</div>
                <p class="text-sm text-gray-400">Need maintenance</p>
            </div>

            <!-- Monthly Revenue -->
            <div class="card-dark p-6">
                <div class="flex items-start justify-between mb-3">
                    <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-xs text-gray-500 uppercase tracking-wider">Monthly Revenue</span>
                </div>
                <div class="text-3xl font-bold text-white mb-1">Rp {{ number_format($stats['monthly_revenue'], 0, ',', '.') }}</div>
                <p class="text-sm text-gray-400">{{ now()->format('F Y') }}</p>
            </div>
        </div>

        <!-- Quick Access -->
        <div>
            <h2 class="text-xl font-semibold text-white mb-4">Quick Access</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.index') }}" class="group card-dark p-6 hover:shadow-lg hover:shadow-[#ADFF2F]/5 transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-[#ADFF2F] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-1">Users</h3>
                    <p class="text-sm text-gray-400">Manage users and members</p>
                </a>

                <a href="{{ route('membership_plan.index') }}" class="group card-dark p-6 hover:shadow-lg hover:shadow-[#ADFF2F]/5 transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-[#ADFF2F] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-1">Membership Plans</h3>
                    <p class="text-sm text-gray-400">Configure membership plans</p>
                </a>

                <a href="{{ route('gym_class.index') }}" class="group card-dark p-6 hover:shadow-lg hover:shadow-[#ADFF2F]/5 transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-[#ADFF2F] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-1">Classes</h3>
                    <p class="text-sm text-gray-400">Manage class schedules</p>
                </a>

                <a href="{{ route('billing.index') }}" class="group card-dark p-6 hover:shadow-lg hover:shadow-[#ADFF2F]/5 transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-[#ADFF2F] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-1">Billing</h3>
                    <p class="text-sm text-gray-400">Payment transactions</p>
                </a>
            </div>
        </div>

        <!-- Management Tools -->
        <div>
            <h2 class="text-xl font-semibold text-white mb-4">Management Tools</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @can('schedule.assign_trainer')
                <a href="{{ route('admin.assignments.index') }}" class="group card-dark p-6 hover:shadow-lg hover:shadow-[#ADFF2F]/5 transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-[#ADFF2F] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-1">Schedules</h3>
                    <p class="text-sm text-gray-400">Assign trainers to classes</p>
                </a>
                @endcan

                @can('attendance.track')
                <a href="{{ route('admin.attendance.index') }}" class="group card-dark p-6 hover:shadow-lg hover:shadow-[#ADFF2F]/5 transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-[#ADFF2F] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-1">Attendance</h3>
                    <p class="text-sm text-gray-400">Track member attendance</p>
                </a>
                @endcan

                @canany(['equipment.manage','equipment.view_all'])
                <a href="{{ route('admin.equipment.index') }}" class="group card-dark p-6 hover:shadow-lg hover:shadow-[#ADFF2F]/5 transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-[#ADFF2F] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-1">Equipment</h3>
                    <p class="text-sm text-gray-400">Manage gym equipment</p>
                </a>
                @endcanany

                @can('workout.manage')
                <a href="{{ route('admin.workouts.index') }}" class="group card-dark p-6 hover:shadow-lg hover:shadow-[#ADFF2F]/5 transition-all">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center">
                            <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <svg class="w-5 h-5 text-gray-600 group-hover:text-[#ADFF2F] transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-1">Workouts</h3>
                    <p class="text-sm text-gray-400">Workout templates & tracking</p>
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
        <div class="w-full mx-auto space-y-8">
            {{-- Header --}}
            <div class="card-header">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                        <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="title">Select Class for Attendance</div>
                        <div class="subtitle">Choose a class to take attendance</div>
                    </div>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('trainer.attendance.view_all') }}" class="btn-primary-custom inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Take New Attendance</span>
                    </a>
                </div>
            </div>

            @if(session('error'))
            <div class="card-dark border-l-4 border-red-500 p-4">
                <div class="flex items-center text-red-400">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
            @endif

            <!-- Search Bar -->
            <div class="card-dark p-4">
                <form method="GET" action="{{ route('trainer.attendance.select-class') }}" class="flex gap-3">
                    <div class="flex-1 relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by class name, day, or room..." class="input-dark w-full pl-10 pr-4 py-2.5">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <button type="submit" class="btn-primary-custom px-6">Search</button>
                    @if(request('search'))
                        <a href="{{ route('trainer.attendance.select-class') }}" class="btn-secondary px-6">Clear</a>
                    @endif
                </form>
            </div>

            {{-- Classes Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 items-stretch auto-rows-fr">
                @if(isset($classes) && $classes->count())
                    @foreach($classes as $class)
                    <div class="card-dark p-6 h-full w-full flex flex-col justify-between hover:border-[#ADFF2F]/50 transition-all duration-200 min-h-[220px]">
                        <div class="flex-1">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-[#ADFF2F]/10 mb-4">
                                <svg class="w-6 h-6 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>

                            <h3 class="text-lg font-bold text-white mb-2">{{ optional($class)->nama_kelas }}</h3>
                            <p class="text-sm text-gray-400 mb-4 line-clamp-2">{{ optional($class)->deskripsi }}</p>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-300">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ optional(optional($class)->waktu_mulai)->format('H:i') ?? '-' }} - {{ optional(optional($class)->waktu_selesai)->format('H:i') ?? '-' }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-300">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <span>{{ optional($class)->durasi ?? '-' }} minutes</span>
                                </div>
                                <div class="flex items-center text-sm text-neutral-300">
                                    <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span>{{ optional(optional($class)->bookings)->count() ?? 0 }} / {{ optional($class)->kapasitas ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('trainer.attendance.track', ['class' => optional($class)->class_id]) }}" class="btn-primary-custom inline-flex items-center justify-center w-full sm:w-auto px-4 py-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                                Take Attendance
                            </a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-span-3">
                        <div class="bg-neutral-800 rounded-lg shadow-lg border border-neutral-700 p-12">
                            <div class="text-center">
                                <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-white">No classes found</h3>
                                <p class="mt-2 text-sm text-neutral-400">Please check your class assignments.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($classes->hasPages())
                <div class="mt-6 flex justify-center">
                    <x-pagination :paginator="$classes" />
                </div>
            @endif
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
        <div class="w-full mx-auto space-y-6">
            @if(session('success'))
                <div class="card-dark p-4 border-l-4 border-[#ADFF2F]">
                    <p class="text-white font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="card-header">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                            <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="title">Your Classes</div>
                            <div class="subtitle">Manage your training sessions and members</div>
                        </div>
                    </div>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('trainer.classes.create') }}" class="btn-primary-custom inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Class
                </a>
                </div>
            </div>
            <div class="card-dark overflow-hidden">
                @if($classes->count() > 0)
                    @php
                        $currentTrainerId = auth()->user()?->trainer?->trainer_id ?? null;
                        $canViewAll = auth()->user()?->hasPermission('schedule.view_all');
                    @endphp
                    <div class="md:hidden p-4 space-y-3">
                        @foreach($classes as $class)
                            <div class="bg-[#1f1f1f] p-4 rounded-lg border border-[#2a2a2a]">
                                <div class="flex items-center justify-between mb-3">
                                    <div>
                                        <div class="text-sm font-semibold text-white">{{ $class->nama_kelas }}</div>
                                        <div class="text-xs text-gray-400">{{ $class->hari ?? '' }} • {{ \Carbon\Carbon::parse($class->waktu_mulai)->format('H:i') }}</div>
                                    </div>
                                    <span class="px-3 py-1 rounded-lg text-xs font-medium bg-[#1f1f1f] border border-[#2a2a2a] text-gray-300">{{ $class->bookings_count ?? $class->bookings->count() }}/{{ $class->kapasitas }}</span>
                                </div>
                                @if($canViewAll || ($currentTrainerId && $class->trainer_id === $currentTrainerId))
                                    <div class="flex gap-2">
                                        <a href="{{ route('trainer.classes.members', $class) }}" class="flex-1 text-center px-3 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] border border-[#2a2a2a] text-white text-sm font-medium rounded-lg transition">Members</a>
                                        <a href="{{ route('trainer.classes.edit', $class) }}" class="flex-1 text-center px-3 py-2 btn-primary-custom text-sm">Edit</a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Desktop: table -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="table-minimal">
                            <thead>
                                <tr>
                                    <th>Class Name</th>
                                    <th>Trainer</th>
                                    <th>Schedule</th>
                                    <th>Duration</th>
                                    <th>Capacity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($classes as $class)
                                    <tr class="hover:bg-neutral-700/20 transition duration-150">
                                        <td>
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-xl flex items-center justify-center mr-3" style="background: rgba(173,255,47,0.1);">
                                                    <svg class="w-5 h-5" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-white">
                                                        {{ $class->nama_kelas }}
                                                    </div>
                                                    <div class="text-xs text-neutral-400 mt-0.5">
                                                        {{ Str::limit($class->deskripsi, 50) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center mr-2" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                                    <span class="text-black font-bold text-xs">{{ substr($class->trainer->user->nama ?? 'T', 0, 1) }}</span>
                                                </div>
                                                <span class="text-sm text-white">{{ $class->trainer->user->nama ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="muted">
                                            <div class="flex items-center text-sm text-neutral-300">
                                                <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $class->hari ?? '' }} - {{ \Carbon\Carbon::parse($class->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($class->waktu_selesai)->format('H:i') }}
                                            </div>
                                        </td>
                                        <td class="muted">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-neutral-700 text-neutral-300">
                                                {{ $class->durasi }} min
                                            </span>
                                        </td>
                                        <td>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-neutral-700 text-neutral-300">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                <p class="text-white font-medium">{{ $class->bookings_count ?? $class->bookings->count() }} / {{ $class->kapasitas }}</p>
                                            </span>
                                        </td>
                                        <td>
                                            @if($canViewAll || ($currentTrainerId && $class->trainer_id === $currentTrainerId))
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('trainer.classes.members', $class) }}"
                                                       class="inline-flex items-center px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-white text-xs font-medium rounded-xl transition-all duration-200 border border-neutral-600 hover:border-neutral-500 shadow-sm hover:shadow-md">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                        </svg>
                                                        Members
                                                    </a>
                                                    <a href="{{ route('trainer.classes.edit', $class) }}"
                                                       class="inline-flex items-center px-4 py-2 bg-[#ADFF2F] hover:bg-[#9FE529] text-black text-xs font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-lg">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('trainer.classes.destroy', $class) }}"
                                                          method="POST"
                                                          class="inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this class?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-4 py-2 bg-red-600/90 hover:bg-red-600 text-white text-xs font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-lg">
                                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-neutral-700 text-neutral-400">
                                                    No actions
                                                </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-neutral-700">
                {{ $classes->links() }}
            </div>
            @else
            <div class="p-12 text-center">
                <div class="inline-block p-4 bg-neutral-800 rounded-full mb-4">
                    <svg class="w-12 h-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="mt-2 text-sm font-medium text-white">No classes found</h3>
                <p class="mt-1 text-sm text-neutral-400">Get started by creating your first class.</p>
                <div class="mt-6">
                    <a href="{{ route('trainer.classes.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-[#ADFF2F] text-black font-medium rounded-lg shadow-sm transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create Your First Class
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
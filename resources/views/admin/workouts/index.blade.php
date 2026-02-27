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
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                    <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <div class="title">Workout Progress Monitoring</div>
                    <div class="subtitle">Monitor all member workout activities</div>
                </div>
            </div>
        </div>

        <div class="card-dark">
            <div class="p-6 border-b border-neutral-700">
                <form method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" 
                               name="search" 
                               value="{{ $search }}" 
                               placeholder="Search by exercise type or member name..."
                               class="w-full px-4 py-2 bg-neutral-800 border border-neutral-700 rounded-lg text-white placeholder-neutral-400 focus:outline-none focus:border-[#ADFF2F] transition">
                    </div>
                    <button type="submit" 
                            class="px-6 py-2 bg-[#ADFF2F] text-black font-semibold rounded-lg hover:bg-[#9FE529] transition-all duration-200">
                        Search
                    </button>
                    @if($search || $memberId)
                    <a href="{{ route('admin.workouts.index') }}" 
                       class="px-6 py-2 bg-neutral-700 text-white font-semibold rounded-lg hover:bg-neutral-600 transition-all duration-200 text-center">
                        Clear
                    </a>
                    @endif
                </form>
            </div>

            @if($search || $memberId)
                @if($workouts->count())
            <div class="overflow-x-auto">
                <table class="table-minimal">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Member</th>
                            <th>Exercise Type</th>
                            <th>Reps</th>
                            <th>Duration</th>
                            <th>Weight</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($workouts as $workout)
                        <tr class="hover:bg-neutral-700/20 transition duration-150">
                            <td>
                                <div class="text-sm font-medium text-white">
                                    {{ $workout->tanggal->format('d M Y') }}
                                </div>
                                <div class="text-xs text-neutral-400">
                                    {{ $workout->tanggal->format('l') }}
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center mr-2" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                        <span class="text-black font-bold text-xs">{{ substr($workout->member->user->nama ?? 'M', 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-white">{{ $workout->member->user->nama ?? 'Member' }}</div>
                                        <div class="text-xs text-neutral-400">ID: {{ $workout->member_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-sm font-medium text-white">{{ $workout->jenis_latihan }}</div>
                            </td>
                            <td>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#ADFF2F] text-black">
                                    {{ $workout->catatan_repetisi }} reps
                                </span>
                            </td>
                            <td class="text-sm text-neutral-400">
                                {{ $workout->catatan_durasi }} min
                            </td>
                            <td>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-600 text-white">
                                    {{ number_format($workout->catatan_berat, 1) }} kg
                                </span>
                            </td>
                            <td>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.workouts.show', $workout->member_id) }}"
                                       class="inline-flex items-center px-3 py-1.5 bg-neutral-700 hover:bg-neutral-600 text-white text-xs font-medium rounded-lg transition">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View All
                                    </a>
                                    <form action="{{ route('admin.workouts.destroy', $workout->progress_id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Delete this workout record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-red-600/90 hover:bg-red-600 text-white text-xs font-medium rounded-lg transition">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-neutral-700">
                {{ $workouts->links() }}
            </div>
            @else
            <div class="p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-white">No workout progress found</h3>
                <p class="mt-1 text-sm text-neutral-400">Try adjusting your search</p>
            </div>
            @endif
            @else
            <div class="p-12 text-center">
                <div class="w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4" style="background: rgba(173, 255, 47, 0.1);">
                    <svg class="h-8 w-8" style="color:#ADFF2F;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-white mb-1">Search Workout Progress</h3>
                <p class="text-sm text-neutral-400">Use the search box above to find member workouts</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

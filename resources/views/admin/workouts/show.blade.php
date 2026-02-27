@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto space-y-6">
        <div class="card-dark">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-[#ADFF2F] rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-white">{{ $member->user->nama ?? 'Member' }}</h3>
                            <p class="text-sm text-neutral-400">{{ $member->user->email ?? '' }} • Member ID: {{ $member->member_id }}</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.workouts.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-white text-sm font-medium rounded-lg transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to All Workouts
                    </a>
                </div>
            </div>
        </div>

        <div class="card-dark overflow-hidden">
            @if($progresses->count())
            <div class="overflow-x-auto">
                <table class="table-minimal">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Exercise Type</th>
                            <th>Reps</th>
                            <th>Duration</th>
                            <th>Weight (kg)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($progresses as $progress)
                        <tr class="hover:bg-neutral-700/20 transition duration-150">
                            <td>
                                <div class="text-sm font-medium text-white">
                                    {{ $progress->tanggal->format('d M Y') }}
                                </div>
                                <div class="text-sm text-neutral-400">
                                    {{ $progress->tanggal->format('l') }}
                                </div>
                            </td>
                            <td>
                                <div class="text-sm font-medium text-white">
                                    {{ $progress->jenis_latihan }}
                                </div>
                            </td>
                            <td>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#ADFF2F] text-black">
                                    {{ $progress->catatan_repetisi }} reps
                                </span>
                            </td>
                            <td class="text-sm text-neutral-400">
                                {{ $progress->catatan_durasi }} min
                            </td>
                            <td>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-600 text-white">
                                    {{ number_format($progress->catatan_berat, 1) }} kg
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.workouts.destroy', $progress->progress_id) }}" 
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
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-neutral-700 bg-neutral-900">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ $progresses->total() }}</div>
                        <div class="text-sm text-neutral-400">Total Workouts</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ $progresses->sum('catatan_repetisi') }}</div>
                        <div class="text-sm text-neutral-400">Total Reps</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ $progresses->sum('catatan_durasi') }}</div>
                        <div class="text-sm text-neutral-400">Total Minutes</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">{{ number_format($progresses->avg('catatan_berat'), 1) }}</div>
                        <div class="text-sm text-neutral-400">Avg Weight (kg)</div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-neutral-700">
                {{ $progresses->links() }}
            </div>
            @else
            <div class="p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-white">No workout progress found</h3>
                <p class="mt-1 text-sm text-neutral-400">This member hasn't logged any workouts yet.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

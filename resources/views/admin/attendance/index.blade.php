@extends('layouts.app')

@section('content')
<div class="py-12 bg-black">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-neutral-800 p-6 shadow sm:rounded-lg text-white">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center" style="color:#ADFF2F;">
                        <i class="bi bi-clipboard-check"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-white mb-0">Attendance</h2>
                        <p class="text-neutral-400 text-sm">Track member attendance & manage records</p>
                    </div>
                </div>
                <a href="{{ route('admin.attendance.create') }}" class="px-4 py-2 rounded-md text-black font-medium" style="background-color:#ADFF2F;">
                    <i class="bi bi-plus-lg me-1"></i> Record Attendance
                </a>
            </div>

            @if(session('ok'))
                <div class="mb-4 p-3 rounded-md text-black" style="background-color:#ADFF2F;">
                    {{ session('ok') }}
                </div>
            @endif

            {{-- Filter Section --}}
            <div class="bg-neutral-700 p-4 rounded-lg mb-6">
                <div class="flex items-center mb-3">
                    <i class="bi bi-funnel text-neutral-400 me-2"></i>
                    <span class="text-neutral-400 font-semibold text-sm">Filter</span>
                </div>
                <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Date</label>
                        <input type="date" name="date" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-800 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" value="{{ $date }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Status</label>
                        <select name="status" class="w-full px-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-800 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">All Status</option>
                            @foreach(['present','absent','late'] as $st)
                                <option value="{{ $st }}" @selected($status===$st)>{{ ucfirst($st) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Search</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-neutral-400">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="q" class="w-full pl-10 pr-3 py-2 border border-neutral-600 rounded-md shadow-sm bg-neutral-800 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" placeholder="Member name / email" value="{{ $q }}">
                        </div>
                    </div>
                    <div class="flex items-end">
                        <button class="w-full px-4 py-2 bg-neutral-600 text-white rounded-md hover:bg-neutral-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            <i class="bi bi-funnel me-1"></i> Filter
                        </button>
                    </div>
                </form>
            </div>

            {{-- Table Section --}}
            <div class="bg-neutral-800 rounded-2xl shadow-2xl overflow-hidden border border-neutral-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-700">
                        <thead class="bg-neutral-900/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">Member</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">Class</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">Check-in</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">Check-out</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-700/50">
                            @forelse($attendances as $a)
                                <tr class="hover:bg-neutral-700/30 transition duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center text-sm text-neutral-300">
                                            <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $a->attendance_date->format('d M Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                                <span class="text-black font-bold text-sm">{{ substr($a->user->nama, 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-white">{{ $a->user->nama }}</div>
                                                <div class="text-xs text-neutral-400 mt-0.5">{{ $a->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($a->schedule)
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-2" style="background: rgba(173,255,47,0.1);">
                                                    <svg class="w-4 h-4" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-white">{{ $a->schedule->class_name }}</div>
                                                    <div class="text-xs text-neutral-400 mt-0.5">
                                                        {{ $a->schedule->class_date->format('d M') }},
                                                        {{ \Illuminate\Support\Carbon::parse($a->schedule->start_time)->format('H:i') }}–{{ \Illuminate\Support\Carbon::parse($a->schedule->end_time)->format('H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-neutral-500 text-sm">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($a->status === 'present')
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-[#ADFF2F] text-black">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Present
                                            </span>
                                        @elseif($a->status === 'late')
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-yellow-600/20 text-yellow-400">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Late
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full bg-neutral-700 text-neutral-400">
                                                {{ ucfirst($a->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center text-sm text-neutral-300">
                                            <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                            </svg>
                                            {{ $a->check_in_at?->format('H:i') ?? '—' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center text-sm text-neutral-300">
                                            <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            {{ $a->check_out_at?->format('H:i') ?? '—' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.attendance.edit', $a) }}"
                                               class="inline-flex items-center px-3 py-1.5 bg-[#ADFF2F] hover:bg-[#9FE529] text-black text-xs font-semibold rounded-lg transition-all duration-200">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.attendance.destroy', $a) }}" method="post" class="inline" onsubmit="return confirm('Delete this record?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-600/90 hover:bg-red-600 text-white text-xs font-semibold rounded-lg transition-all duration-200">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background: rgba(173,255,47,0.1);">
                                                <svg class="w-8 h-8" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-xl font-bold text-white mb-2">No attendance records</h3>
                                            <p class="text-neutral-400 mb-6">Create your first record to get started</p>
                                            <a href="{{ route('admin.attendance.create') }}"
                                               class="inline-flex items-center px-6 py-3 bg-[#ADFF2F] hover:bg-[#9FE529] text-black font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Record Attendance
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($attendances->hasPages())
                    <div class="px-6 py-5 border-t border-neutral-700 bg-neutral-900/30">
                        {{ $attendances->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
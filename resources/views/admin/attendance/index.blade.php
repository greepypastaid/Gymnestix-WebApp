@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto space-y-6">
        {{-- Header --}}
        <div class="card-header">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                    <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <div class="title">Attendance Management</div>
                    <div class="subtitle">Track member attendance & manage records</div>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('admin.attendance.create') }}" class="btn-primary-custom flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Record Attendance
                </a>
            </div>
        </div>

        @if(session('ok'))
        <div class="card-dark p-4 border-l-4 border-[#ADFF2F]">
            <p class="text-white font-medium">{{ session('ok') }}</p>
        </div>
        @endif

        {{-- Filter Section --}}
        <div class="card-dark p-6">
            <h3 class="text-sm font-medium text-gray-400 mb-4">Filters</h3>
            <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Date</label>
                    <input type="date" name="date" class="input-dark w-full" value="{{ $date }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Status</label>
                    <select name="status" class="input-dark w-full">
                        <option value="">All Status</option>
                        @foreach(['present','absent','late'] as $st)
                            <option value="{{ $st }}" @selected($status===$st)>{{ ucfirst($st) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Search</label>
                    <input type="text" name="q" class="input-dark w-full" placeholder="Member name / email" value="{{ $q }}">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full px-4 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white rounded-lg font-medium transition">
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        {{-- Table / Mobile List --}}
        <div class="card-dark overflow-hidden">
            <!-- Mobile: cards -->
            <div class="md:hidden p-4 space-y-3">
                @forelse($attendances as $a)
                    <div class="bg-[#1f1f1f] p-4 rounded-lg border border-[#2a2a2a]">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <div class="text-sm font-semibold text-white">{{ $a->user?->nama ?? 'User Terhapus' }}</div>
                                <div class="text-xs text-gray-400">{{ $a->attendance_date?->format('d M Y') ?? '-' }} • {{ $a->schedule?->class_name ?? '—' }}</div>
                            </div>
                            <div>
                                @if($a->status === 'present')
                                    <span class="px-3 py-1 text-xs font-semibold rounded-lg bg-[#ADFF2F]/20 text-[#ADFF2F]">Present</span>
                                @elseif($a->status === 'late')
                                    <span class="px-3 py-1 text-xs font-semibold rounded-lg bg-yellow-500/20 text-yellow-400">Late</span>
                                @else
                                    <span class="px-3 py-1 text-xs font-semibold rounded-lg bg-red-500/20 text-red-400">{{ ucfirst($a->status) }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.attendance.edit', $a) }}" class="flex-1 text-center px-3 py-2 btn-primary-custom text-sm">Edit</a>
                            <form action="{{ route('admin.attendance.destroy', $a) }}" method="post" onsubmit="return confirm('Delete this record?')" class="flex-1">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full px-3 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 rounded-lg text-sm font-medium transition">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-400">No attendance records found</div>
                @endforelse
            </div>

                <!-- Desktop: table -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="table-minimal">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Member</th>
                                <th>Class</th>
                                <th>Status</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $a)
                                <tr class="hover:bg-neutral-700/20 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center text-sm text-neutral-300">
                                            <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $a->attendance_date?->format('d M Y') ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                                <span class="text-black font-bold text-sm">{{ substr($a->user?->nama ?? '?', 0, 1) }}</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-white">{{ $a->user?->nama ?? 'User Terhapus' }}</div>
                                                <div class="text-xs text-neutral-400 mt-0.5">{{ $a->user?->email ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($a->gymClass)
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-2" style="background: rgba(173,255,47,0.1);">
                                                    <svg class="w-4 h-4" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-white">{{ $a->gymClass->nama_kelas }}</div>
                                                    <div class="text-xs text-neutral-400 mt-0.5">
                                                        {{ \Illuminate\Support\Carbon::parse($a->gymClass->waktu_mulai)->format('H:i') }}–{{ \Illuminate\Support\Carbon::parse($a->gymClass->waktu_selesai)->format('H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif($a->schedule)
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-2" style="background: rgba(173,255,47,0.1);">
                                                    <svg class="w-4 h-4" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-white">{{ $a->schedule->class_name }}</div>
                                                    <div class="text-xs text-neutral-400 mt-0.5">
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
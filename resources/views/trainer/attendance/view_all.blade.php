@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
        <div class="w-full mx-auto space-y-4">
            {{-- Header --}}
            <div class="card-header">
                <div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                            <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10" />
                            </svg>
                        </div>
                        <div>
                            <div class="title">Attendance History</div>
                            <div class="subtitle">View all attendance records</div>
                        </div>
                    </div>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('trainer.attendance.select-class') }}" class="btn-primary-custom w-full sm:w-auto inline-flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Take New Attendance</span>
                    </a>
                </div>
            </div>

            {{-- Attendance Table --}}
            <div class="card-dark overflow-hidden">
                @if($groupedAttendances->count())
                    @foreach($groupedAttendances as $date => $dateAttendances)
                        <div class="border-b border-neutral-700 last:border-b-0">
                            <div class="bg-neutral-800/50 px-6 py-3 flex items-center gap-3">
                                <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <h3 class="text-sm font-semibold text-white">{{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}</h3>
                                <span class="ml-auto text-xs text-neutral-400">{{ $dateAttendances->count() }} records</span>
                            </div>

                            <!-- Mobile: cards -->
                            <div class="md:hidden p-4 space-y-3">
                                @foreach($dateAttendances as $attendance)
                                    <div class="bg-neutral-900/40 p-4 rounded-lg border border-neutral-700">
                                        <div class="flex items-center justify-between mb-3">
                                            <div>
                                                <div class="text-sm font-semibold text-white">{{ $attendance->member->user->nama }}</div>
                                                <div class="text-xs text-neutral-400">{{ $attendance->class->nama_kelas }}</div>
                                            </div>
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $attendance->status === 'hadir' ? 'bg-[#ADFF2F] text-black' : ($attendance->status === 'izin' ? 'bg-yellow-500 text-white' : ($attendance->status === 'sakit' ? 'bg-orange-500 text-white' : 'bg-red-600 text-white')) }}">{{ ucfirst($attendance->status) }}</span>
                                        </div>
                                        <div class="text-xs text-neutral-400">
                                            <div>Time: {{ $attendance->waktu_masuk->format('H:i') }} - {{ $attendance->waktu_keluar->format('H:i') }}</div>
                                            @if($attendance->catatan)
                                                <div class="mt-1">Notes: {{ $attendance->catatan }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Desktop: table -->
                            <div class="hidden md:block overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-neutral-800/30">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                                Class
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                                Member
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                                Time
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                                Notes
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-neutral-900/20">
                                        @foreach($dateAttendances as $attendance)
                                            <tr class="border-t border-neutral-700 hover:bg-neutral-700/20 transition duration-150">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-semibold text-white">
                                                        {{ $attendance->class->nama_kelas }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="w-8 h-8 rounded-full flex items-center justify-center mr-2" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                                            <span class="text-black font-bold text-xs">{{ substr($attendance->member->user->nama ?? 'M', 0, 1) }}</span>
                                                        </div>
                                                        <span class="text-sm font-medium text-white">
                                                            {{ $attendance->member->user->nama }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        {{ $attendance->status === 'hadir' ? 'bg-[#ADFF2F] text-black' :
                                                           ($attendance->status === 'izin' ? 'bg-yellow-500 text-white' :
                                                           ($attendance->status === 'sakit' ? 'bg-orange-500 text-white' :
                                                            'bg-red-600 text-white')) }}">
                                                        {{ ucfirst($attendance->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center text-sm text-neutral-400">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        {{ $attendance->waktu_masuk->format('H:i') }} - {{ $attendance->waktu_keluar->format('H:i') }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-neutral-400">
                                                    {{ $attendance->catatan ?: '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach

                    <div class="px-6 py-4 border-t border-neutral-700">
                        {{ $attendances->links() }}
                    </div>
                @else
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="mt-4 text-sm text-neutral-400">No attendance records found.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
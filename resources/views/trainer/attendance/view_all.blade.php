<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Attendance Records
        </h2>
    </x-slot>

    <div class="py-12 bg-black min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Header --}}
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white">Attendance History</h1>
                    <p class="mt-1 text-neutral-400">View all attendance records</p>
                </div>
                <a href="{{ route('trainer.attendance.select-class') }}"
                   class="px-6 py-3 rounded-lg font-semibold text-black hover:bg-[#9FE529] inline-flex items-center space-x-2 transition-all duration-200" style="background-color:#ADFF2F;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Take New Attendance</span>
                </a>
            </div>

            {{-- Attendance Table --}}
            <div class="bg-neutral-800 shadow sm:rounded-lg overflow-hidden border border-white">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-700">
                        <thead class="bg-neutral-900/50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                    Class
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                    Member
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                    Time
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                    Notes
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-neutral-800 divide-y divide-neutral-700/50">
                            @forelse($attendances as $attendance)
                                <tr class="hover:bg-neutral-700/30 transition duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 bg-neutral-700">
                                                <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm text-neutral-300">{{ $attendance->tanggal->format('Y-m-d') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-white">
                                            {{ $attendance->class->nama_kelas }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center mr-2" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                                <span class="text-black font-bold text-xs">{{ substr($attendance->member->user->name ?? 'M', 0, 1) }}</span>
                                            </div>
                                            <span class="text-sm font-medium text-white">
                                                {{ $attendance->member->user->name }}
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
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="mt-4 text-sm text-neutral-400">No attendance records found.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
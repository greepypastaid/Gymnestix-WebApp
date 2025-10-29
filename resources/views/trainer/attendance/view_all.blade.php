<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Attendance Records') }}
            </h2>
            <a href="{{ route('trainer.attendance.select-class') }}"
               class="inline-flex items-center px-4 py-2 bg-[#ADFF2F] border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-[#9FE529] transition duration-200">
                Take New Attendance
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-neutral-800 overflow-hidden shadow-xl sm:rounded-lg border border-neutral-700">
                <div class="p-6 bg-neutral-800 border-b border-neutral-700">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-neutral-700">
                            <thead class="bg-neutral-900">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                        Class
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                        Member
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                        Time
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                        Notes
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-neutral-800 divide-y divide-neutral-700">
                                @forelse($attendances as $attendance)
                                    <tr class="hover:bg-neutral-700">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-400">
                                            {{ $attendance->tanggal->format('Y-m-d') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-white">
                                                {{ $attendance->class->nama_kelas }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-white">
                                                {{ $attendance->member->user->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $attendance->status === 'hadir' ? 'bg-[#ADFF2F] text-black' :
                                                   ($attendance->status === 'izin' ? 'bg-yellow-500 text-white' :
                                                   ($attendance->status === 'sakit' ? 'bg-orange-500 text-white' :
                                                    'bg-red-600 text-white')) }}">
                                                {{ ucfirst($attendance->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral-400">
                                            {{ $attendance->waktu_masuk->format('H:i') }} - {{ $attendance->waktu_keluar->format('H:i') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-neutral-400">
                                            {{ $attendance->catatan ?: '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-neutral-400 text-center">
                                            No attendance records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Members of') }} {{ $class->nama_kelas }}
            </h2>
            <a href="{{ route('trainer.classes.index') }}" class="inline-flex items-center px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-neutral-600 transition duration-200">
                Back to Classes
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-neutral-800 overflow-hidden shadow-xl sm:rounded-lg border border-neutral-700">
                <div class="p-6 text-white">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-white">Class Details</h3>
                        <dl class="mt-2 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <dt class="text-sm font-medium text-neutral-400">Schedule</dt>
                                <dd class="mt-1 text-sm text-white">{{ $class->waktu_mulai->format('H:i') }} - {{ $class->waktu_selesai->format('H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-neutral-400">Duration</dt>
                                <dd class="mt-1 text-sm text-white">{{ $class->durasi }} minutes</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-neutral-400">Capacity</dt>
                                <dd class="mt-1 text-sm text-white">{{ $members->count() }} / {{ $class->kapasitas }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="border-t border-neutral-700 pt-6">
                        <h3 class="text-lg font-medium text-white mb-4">Enrolled Members</h3>
                        @if($members->isEmpty())
                            <p class="text-neutral-400 text-center py-4">No members are currently enrolled in this class.</p>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-neutral-700">
                                    <thead class="bg-neutral-900">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                                Email
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                                Phone
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                                Join Date
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-300 uppercase tracking-wider">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-neutral-800 divide-y divide-neutral-700">
                                        @foreach($members as $booking)
                                            <tr class="hover:bg-neutral-700">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-white">
                                                        {{ optional($booking->member->user)->nama ?? 'Member' }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-neutral-400">
                                                        {{ optional($booking->member->user)->email ?? '' }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-neutral-400">
                                                        {{ optional($booking->member->user)->nomor_telepon ?? '' }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-neutral-400">
                                                        {{ $booking->created_at->format('M d, Y') }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-[#ADFF2F] text-black">
                                                        Active
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
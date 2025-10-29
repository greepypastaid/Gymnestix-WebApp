<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Track Attendance') }}
            </h2>
            <div class="text-right">
                <p class="text-white">{{ $class->nama_kelas }}</p>
                <p class="text-sm text-neutral-400">{{ $class->waktu_mulai->format('H:i') }} - {{ $class->waktu_selesai->format('H:i') }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-neutral-800 p-4 border border-neutral-700 rounded-lg text-white mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="bg-neutral-800 overflow-hidden shadow-xl sm:rounded-lg border border-neutral-700">
                <form method="POST" action="{{ route('trainer.attendance.store', ['class' => $class->class_id]) }}">
                    @csrf
                    <div class="p-6 bg-neutral-800 border-b border-neutral-700">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-white mb-4">Members</h3>
                            <div class="grid gap-6">
                                @forelse($members as $member)
                                    <div class="flex items-center justify-between p-4 border rounded-lg bg-neutral-900 border-neutral-600">
                                        <div class="flex items-center space-x-4">
                                            <div>
                                                <h4 class="font-medium text-white">{{ optional($member->user)->nama ?? 'Member' }}</h4>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <div class="space-x-2">
                                                <div class="inline-flex rounded-md shadow-sm" role="group" aria-label="Attendance options">
                                                    <label class="relative">
                                                        <input type="radio" name="attendance[{{ $member->member_id }}]" value="hadir" class="sr-only peer" checked>
                                                        <span class="px-3 py-1 text-sm border border-neutral-600 rounded-l-md bg-neutral-800 text-neutral-300 peer-checked:bg-[#ADFF2F] peer-checked:text-black peer-checked:border-[#ADFF2F]">Present</span>
                                                    </label>
                                                    <label class="relative">
                                                        <input type="radio" name="attendance[{{ $member->member_id }}]" value="izin" class="sr-only peer">
                                                        <span class="-ml-px px-3 py-1 text-sm border border-neutral-600 bg-neutral-800 text-neutral-300 peer-checked:bg-yellow-500 peer-checked:text-white peer-checked:border-yellow-500">Excused</span>
                                                    </label>
                                                    <label class="relative">
                                                        <input type="radio" name="attendance[{{ $member->member_id }}]" value="sakit" class="sr-only peer">
                                                        <span class="-ml-px px-3 py-1 text-sm border border-neutral-600 bg-neutral-800 text-neutral-300 peer-checked:bg-orange-500 peer-checked:text-white peer-checked:border-orange-500">Sick</span>
                                                    </label>
                                                    <label class="relative">
                                                        <input type="radio" name="attendance[{{ $member->member_id }}]" value="alpa" class="sr-only peer">
                                                        <span class="-ml-px px-3 py-1 text-sm border border-neutral-600 rounded-r-md bg-neutral-800 text-neutral-300 peer-checked:bg-red-600 peer-checked:text-white peer-checked:border-red-600">Absent</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <input type="text"
                                                   name="notes[{{ $member->member_id }}]"
                                                   placeholder="Add note for this member"
                                                   class="form-input rounded-md shadow-sm mt-1 block w-full bg-neutral-700 border-neutral-600 text-white focus:ring-[#ADFF2F] focus:border-[#ADFF2F]">
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-neutral-400 py-4">
                                        No members found in this class.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="general_notes" class="block text-sm font-medium text-white mb-2">
                                General Notes
                            </label>
                            <textarea id="general_notes"
                                      name="general_notes"
                                      rows="3"
                                      class="shadow-sm focus:ring-[#ADFF2F] focus:border-[#ADFF2F] block w-full sm:text-sm border-neutral-600 rounded-md bg-neutral-700 text-white"
                                      placeholder="Add any general notes for this session"></textarea>
                        </div>

                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('trainer.attendance.select-class') }}"
                               class="bg-neutral-600 hover:bg-neutral-500 text-white font-bold py-2 px-4 rounded inline-flex items-center transition duration-200">
                                Back to Class Selection
                            </a>
                            <button type="submit"
                                    class="bg-[#ADFF2F] hover:bg-[#9FE529] text-black font-bold py-2 px-4 rounded inline-flex items-center transition duration-200">
                                Save Attendance
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
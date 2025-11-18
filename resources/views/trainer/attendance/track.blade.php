<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Track Attendance
        </h2>
    </x-slot>

    <div class="py-12 bg-black min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Header --}}
            <div class="bg-neutral-800 p-6 shadow sm:rounded-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(173,255,47,0.1); color:#ADFF2F;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">{{ $class->nama_kelas }}</h1>
                            <p class="text-neutral-400">{{ $class->waktu_mulai->format('H:i') }} - {{ $class->waktu_selesai->format('H:i') }}</p>
                        </div>
                    </div>
                    <a href="{{ route('trainer.attendance.select-class') }}" class="px-4 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium flex items-center space-x-2 transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Back</span>
                    </a>
                </div>
            </div>

            @if(session('success'))
            <div class="bg-neutral-800 p-4 border-l-4 rounded-lg text-white" style="border-color:#ADFF2F;">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3" style="background: rgba(173,255,47,0.1);">
                        <svg class="w-5 h-5" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            {{-- Attendance Form --}}
            <div class="bg-neutral-800 shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('trainer.attendance.store', ['class' => $class->class_id]) }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-4">Members Attendance</h3>
                        <div class="space-y-4">
                            @forelse($members as $member)
                                <div class="flex items-center justify-between p-4 rounded-lg bg-neutral-900 border border-neutral-700 hover:border-neutral-600 transition duration-200">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                            <span class="text-black font-bold text-sm">{{ substr(optional($member->user)->nama ?? 'M', 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-white">{{ optional($member->user)->nama ?? 'Member' }}</h4>
                                            <p class="text-sm text-neutral-400">{{ optional($member->user)->email ?? '' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="inline-flex rounded-lg overflow-hidden border border-neutral-600" role="group">
                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="attendance[{{ $member->member_id }}]" value="hadir" class="sr-only peer" checked>
                                                <span class="px-4 py-2 text-sm bg-neutral-800 text-neutral-300 peer-checked:bg-[#ADFF2F] peer-checked:text-black font-medium transition-colors duration-200">Present</span>
                                            </label>
                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="attendance[{{ $member->member_id }}]" value="izin" class="sr-only peer">
                                                <span class="px-4 py-2 text-sm bg-neutral-800 text-neutral-300 peer-checked:bg-yellow-500 peer-checked:text-white font-medium transition-colors duration-200 border-l border-neutral-600">Excused</span>
                                            </label>
                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="attendance[{{ $member->member_id }}]" value="sakit" class="sr-only peer">
                                                <span class="px-4 py-2 text-sm bg-neutral-800 text-neutral-300 peer-checked:bg-orange-500 peer-checked:text-white font-medium transition-colors duration-200 border-l border-neutral-600">Sick</span>
                                            </label>
                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="attendance[{{ $member->member_id }}]" value="alpa" class="sr-only peer">
                                                <span class="px-4 py-2 text-sm bg-neutral-800 text-neutral-300 peer-checked:bg-red-600 peer-checked:text-white font-medium transition-colors duration-200 border-l border-neutral-600">Absent</span>
                                            </label>
                                        </div>
                                        <input type="text"
                                               name="notes[{{ $member->member_id }}]"
                                               placeholder="Add note..."
                                               class="w-48 px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]">
                                    </div>
                                </div>
                            @empty
                                <div class="p-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <p class="mt-4 text-neutral-400">No members found in this class.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div>
                        <label for="general_notes" class="block text-sm font-medium text-white mb-2">
                            General Notes
                        </label>
                        <textarea id="general_notes"
                                  name="general_notes"
                                  rows="3"
                                  class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]"
                                  placeholder="Add any general notes for this session"></textarea>
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-4">
                        <a href="{{ route('trainer.attendance.select-class') }}"
                           class="px-6 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium transition duration-200">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-6 py-2 rounded-lg font-semibold text-black hover:bg-[#9FE529] inline-flex items-center space-x-2 transition-all duration-200" style="background-color:#ADFF2F;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Save Attendance</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto space-y-6">
        {{-- Header --}}
        <div class="card-header">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                        <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="title">Track Attendance</div>
                        <div class="subtitle">{{ $class->nama_kelas }} • {{ $class->waktu_mulai->format('H:i') }} - {{ $class->waktu_selesai->format('H:i') }}</div>
                    </div>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('trainer.attendance.select-class') }}" class="px-4 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white rounded-lg font-medium transition-colors">
                    ← Back
                </a>
            </div>
        </div>

        @if(session('success'))
        <div class="card-dark border-l-4 border-[#ADFF2F] p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center bg-[#ADFF2F]/10 text-[#ADFF2F]">
                    ✓
                </div>
                <p class="text-white font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        {{-- Attendance Form --}}
        <div class="card-dark p-6">
            <form method="POST" action="{{ route('trainer.attendance.store', ['class' => $class->class_id]) }}" class="space-y-6">
                @csrf

                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Members Attendance</h3>
                    <div class="space-y-4">
                        @forelse($members as $member)
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between p-4 rounded-lg bg-[#1f1f1f] border border-[#2a2a2a] hover:border-[#ADFF2F] transition duration-200">
                                <div class="flex items-center space-x-4 mb-3 md:mb-0">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-gradient-to-br from-[#ADFF2F] to-[#7CB518]">
                                        <span class="text-black font-bold text-sm">{{ substr(optional($member->member->user)->nama ?? 'M', 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-white">{{ optional($member->member->user)->nama ?? 'Member' }}</h4>
                                        <p class="text-sm text-gray-400">{{ optional($member->member->user)->email ?? '' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="inline-flex rounded-lg overflow-hidden border border-[#2a2a2a]" role="group">
                                        <label class="relative cursor-pointer">
                                            <input type="radio" name="attendance[{{ $member->member_id }}]" value="hadir" class="sr-only peer" checked>
                                            <span class="px-4 py-2 text-sm bg-[#141414] text-gray-300 peer-checked:bg-[#ADFF2F] peer-checked:text-black font-medium transition-colors duration-150">Present</span>
                                        </label>
                                        <label class="relative cursor-pointer">
                                            <input type="radio" name="attendance[{{ $member->member_id }}]" value="izin" class="sr-only peer">
                                            <span class="px-4 py-2 text-sm bg-[#141414] text-gray-300 peer-checked:bg-yellow-500 peer-checked:text-white font-medium transition-colors duration-150 border-l border-[#2a2a2a]">Excused</span>
                                        </label>
                                        <label class="relative cursor-pointer">
                                            <input type="radio" name="attendance[{{ $member->member_id }}]" value="sakit" class="sr-only peer">
                                            <span class="px-4 py-2 text-sm bg-[#141414] text-gray-300 peer-checked:bg-orange-500 peer-checked:text-white font-medium transition-colors duration-150 border-l border-[#2a2a2a]">Sick</span>
                                        </label>
                                        <label class="relative cursor-pointer">
                                            <input type="radio" name="attendance[{{ $member->member_id }}]" value="alpa" class="sr-only peer">
                                            <span class="px-4 py-2 text-sm bg-[#141414] text-gray-300 peer-checked:bg-red-600 peer-checked:text-white font-medium transition-colors duration-150 border-l border-[#2a2a2a]">Absent</span>
                                        </label>
                                    </div>

                                    <input type="text"
                                           name="notes[{{ $member->member_id }}]"
                                           placeholder="Add note..."
                                           class="input-dark w-48 text-sm">
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center text-gray-400">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <p class="mt-4">No members found in this class.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div>
                    <label for="general_notes" class="block text-sm font-medium text-gray-400 mb-2">General Notes</label>
                    <textarea id="general_notes" name="general_notes" rows="3" class="input-dark w-full" placeholder="Add any general notes for this session"></textarea>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-4">
                    <a href="{{ route('trainer.attendance.select-class') }}" class="px-6 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white rounded-lg font-medium transition-colors">Cancel</a>
                    <button type="submit" class="btn-primary-custom inline-flex items-center space-x-2">
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

@endsection
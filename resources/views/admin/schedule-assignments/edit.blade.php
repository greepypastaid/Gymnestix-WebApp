@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto">
        {{-- Header --}}
        <div class="card-header mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                    <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <div class="title">Edit Schedule & Assign Trainer</div>
                    <div class="subtitle">Update schedule information and trainer assignment</div>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('admin.assignments.index') }}" class="px-4 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white rounded-lg font-medium transition-colors inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>

        @if(session('ok'))
        <div class="mb-6 card-dark border-l-4 border-[#ADFF2F] p-4">
            <p class="text-[#ADFF2F]">{{ session('ok') }}</p>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 card-dark border-l-4 border-red-500 p-4">
            <ul class="list-disc list-inside text-red-400 space-y-1">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <div class="card-dark p-6">
            <form method="post" action="{{ route('admin.assignments.update', $schedule) }}" class="space-y-6">
                @csrf 
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-400 mb-2">Class Name</label>
                        <input name="class_name" class="input-dark w-full" value="{{ old('class_name', $schedule->class_name ?? '') }}" required placeholder="e.g. Morning Yoga">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Date</label>
                        <input type="date" name="class_date" class="input-dark w-full" value="{{ old('class_date', isset($schedule) ? $schedule->class_date->format('Y-m-d') : '') }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Room</label>
                        <input name="room" class="input-dark w-full" value="{{ old('room', $schedule->room ?? '') }}" placeholder="e.g. Studio A">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Start Time</label>
                        <input type="time" name="start_time" class="input-dark w-full" value="{{ old('start_time', isset($schedule) ? $schedule->start_time->format('H:i') : '') }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">End Time</label>
                        <input type="time" name="end_time" class="input-dark w-full" value="{{ old('end_time', isset($schedule) ? $schedule->end_time->format('H:i') : '') }}" required>
                    </div>
                </div>

                <hr class="my-6 border-[#2a2a2a]">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-400 mb-2">Trainer</label>
                        <select name="trainer_id" class="input-dark w-full">
                            <option value="">— Not Assigned —</option>
                            @foreach($trainers as $t)
                                <option value="{{ $t->user_id }}" @selected(optional($assignment)->trainer_id == $t->user_id)>{{ $t->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Notes</label>
                        <input name="notes" class="input-dark w-full" value="{{ old('notes', $assignment->notes ?? '') }}" placeholder="Additional notes">
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-3 sm:space-y-0">
                    <button type="submit" class="w-full sm:w-auto px-6 py-2 rounded-lg font-medium flex items-center justify-center sm:justify-start space-x-2 text-black hover:bg-[#9FE529] transition-all duration-200" style="background-color:#ADFF2F;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Update Schedule</span>
                    </button>
                    <a href="{{ route('admin.assignments.index') }}" class="w-full sm:w-auto text-center px-6 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium transition duration-200">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

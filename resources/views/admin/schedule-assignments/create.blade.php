@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto">
        {{-- Header --}}
        <div class="card-header mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                    <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <div class="title">Create New Schedule</div>
                    <div class="subtitle">Add a new class schedule</div>
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

        @if($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-500/20 border border-red-500/30">
            <ul class="list-disc list-inside text-red-400 space-y-1">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <div class="card-dark p-6">
            <form method="post" action="{{ route('admin.assignments.store') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-400 mb-2">Class Name</label>
                        <input name="class_name" class="input-dark w-full" value="{{ old('class_name') }}" required placeholder="e.g. Morning Yoga">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Date</label>
                        <input type="date" name="class_date" class="input-dark w-full" value="{{ old('class_date') }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Room</label>
                        <input name="room" class="input-dark w-full" value="{{ old('room') }}" placeholder="e.g. Studio A">
                    </div>
                    <div>
                        <label class="block text-gray-400 mb-2">Start Time</label>
                        <input type="time" name="start_time" class="input-dark w-full" value="{{ old('start_time') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">End Time</label>
                        <input type="time" name="end_time" class="input-dark w-full" value="{{ old('end_time') }}" required>
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-3 sm:space-y-0">
                    <button type="submit" class="w-full sm:w-auto px-6 py-2 rounded-lg font-medium flex items-center justify-center sm:justify-start space-x-2 text-black hover:bg-[#9FE529] transition-all duration-200" style="background-color:#ADFF2F;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Create Schedule</span>
                    </button>
                    <a href="{{ route('admin.assignments.index') }}" class="w-full sm:w-auto text-center px-6 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium transition duration-200">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="py-12 bg-black min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="bg-neutral-800 p-6 shadow sm:rounded-lg mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(173,255,47,0.1); color:#ADFF2F;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Create New Schedule</h1>
                        <p class="text-neutral-400">Add a new class schedule</p>
                    </div>
                </div>
                <a href="{{ route('admin.assignments.index') }}" class="px-4 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium flex items-center space-x-2 transition duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back</span>
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
        <div class="bg-neutral-800 shadow sm:rounded-lg p-6">
            <form method="post" action="{{ route('admin.assignments.store') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Class Name</label>
                        <input name="class_name" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('class_name') }}" required placeholder="e.g. Morning Yoga">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Date</label>
                        <input type="date" name="class_date" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('class_date') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Room</label>
                        <input name="room" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('room') }}" placeholder="e.g. Studio A">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">Start Time</label>
                        <input type="time" name="start_time" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('start_time') }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-white mb-2">End Time</label>
                        <input type="time" name="end_time" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('end_time') }}" required>
                    </div>
                </div>

                <div class="mt-8 flex items-center space-x-4">
                    <button type="submit" class="px-6 py-2 rounded-lg font-medium flex items-center space-x-2 text-black hover:bg-[#9FE529] transition-all duration-200" style="background-color:#ADFF2F;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Create Schedule</span>
                    </button>
                    <a href="{{ route('admin.assignments.index') }}" class="px-6 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium transition duration-200">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="py-12 bg-black min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <!-- Header with Action -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">Schedule & Trainer Assignment</h1>
                <p class="mt-1 text-neutral-400">Assign trainers to class schedules</p>
            </div>
            <a href="{{ route('admin.assignments.create') }}"
               class="inline-flex items-center px-6 py-3 bg-[#ADFF2F] hover:bg-[#9FE529] text-black font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Create Schedule
            </a>
        </div>

        <!-- Search -->
        <div class="bg-neutral-800 rounded-2xl p-6 shadow-xl border border-neutral-700">
            <form method="get">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="q" value="{{ $q }}" 
                           class="block w-full pl-12 pr-4 py-3 border border-neutral-600 rounded-xl bg-neutral-700 text-white placeholder-neutral-400 focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" 
                           placeholder="Search class or room...">
                </div>
            </form>
        </div>

        <!-- Schedules Table -->
        <div class="bg-neutral-800 rounded-2xl shadow-2xl overflow-hidden border border-neutral-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-700">
                    <thead class="bg-neutral-900/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                Class
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                Time
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                Room
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                Trainer
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-700/50">
                        @forelse($schedules as $s)
                            <tr class="hover:bg-neutral-700/30 transition duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mr-3" style="background: rgba(173,255,47,0.1);">
                                            <svg class="w-5 h-5" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-semibold text-white">{{ $s->class_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center text-sm text-neutral-300">
                                        <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $s->class_date->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center text-sm text-neutral-300">
                                        <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $s->start_time->format('H:i') }} – {{ $s->end_time->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-neutral-700 text-neutral-300">
                                        {{ $s->room ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(optional($s->assignments->first()?->trainer)->nama)
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center mr-2" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                                <span class="text-black font-bold text-xs">{{ substr(optional($s->assignments->first()?->trainer)->nama, 0, 1) }}</span>
                                            </div>
                                            <span class="text-sm text-white">{{ optional($s->assignments->first()?->trainer)->nama }}</span>
                                        </div>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-600/20 text-orange-400">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Not assigned
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.assignments.edit', $s) }}"
                                           class="inline-flex items-center px-4 py-2 bg-[#ADFF2F] hover:bg-[#9FE529] text-black text-xs font-semibold rounded-xl transition-all duration-200">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Assign / Edit
                                        </a>
                                        <form action="{{ route('admin.assignments.destroy', $s) }}" method="post" class="inline" onsubmit="return confirm('Delete schedule?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 bg-red-600/90 hover:bg-red-600 text-white text-xs font-semibold rounded-xl transition-all duration-200">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background: rgba(173,255,47,0.1);">
                                            <svg class="w-8 h-8" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-xl font-bold text-white mb-2">No schedules found</h3>
                                        <p class="text-neutral-400 mb-6">Create your first schedule to get started.</p>
                                        <a href="{{ route('admin.assignments.create') }}"
                                           class="inline-flex items-center px-6 py-3 bg-[#ADFF2F] hover:bg-[#9FE529] text-black font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                            Create Schedule
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($schedules->hasPages())
                <div class="px-6 py-5 border-t border-neutral-700 bg-neutral-900/30">
                    {{ $schedules->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
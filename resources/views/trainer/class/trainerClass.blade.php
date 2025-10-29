<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Class Management
        </h2>
    </x-slot>

    <div class="py-12 bg-black min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-neutral-800 p-6 border-l-4 border-[#ADFF2F] rounded-2xl text-white shadow-xl">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-4" style="background: rgba(173,255,47,0.1);">
                            <svg class="w-6 h-6" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Header with Action -->
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white">Your Classes</h1>
                    <p class="mt-1 text-neutral-400">Manage your training sessions and members</p>
                </div>
                <a href="{{ route('trainer.classes.create') }}"
                   class="inline-flex items-center px-6 py-3 bg-[#ADFF2F] hover:bg-[#9FE529] text-black font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create Class
                </a>
            </div>

            <!-- Classes List -->
            <div class="bg-neutral-800 rounded-2xl shadow-2xl overflow-hidden border border-neutral-700">
                @if($classes->count())
                    @php
                        $currentTrainerId = auth()->user()?->trainer?->trainer_id ?? null;
                        $canViewAll = auth()->user()?->hasPermission('schedule.view_all');
                    @endphp
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-neutral-700">
                            <thead class="bg-neutral-900/50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                        Class Name
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                        Trainer
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                        Schedule
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                        Duration
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                        Capacity
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-neutral-800 divide-y divide-neutral-700/50">
                                @foreach($classes as $class)
                                    <tr class="hover:bg-neutral-700/30 transition duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-xl flex items-center justify-center mr-3" style="background: rgba(173,255,47,0.1);">
                                                    <svg class="w-5 h-5" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-white">
                                                        {{ $class->nama_kelas }}
                                                    </div>
                                                    <div class="text-xs text-neutral-400 mt-0.5">
                                                        {{ Str::limit($class->deskripsi, 50) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center mr-2" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                                    <span class="text-black font-bold text-xs">{{ substr($class->trainer->user->nama ?? 'T', 0, 1) }}</span>
                                                </div>
                                                <span class="text-sm text-white">{{ $class->trainer->user->nama ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center text-sm text-neutral-300">
                                                <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $class->waktu_mulai }} - {{ $class->waktu_selesai }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-neutral-700 text-neutral-300">
                                                {{ $class->durasi }} min
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-neutral-700 text-neutral-300">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                {{ $class->kapasitas }}
                                            </span>
                                        </td>
                                            {{ $class->kapasitas }} people
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($canViewAll || ($currentTrainerId && $class->trainer_id === $currentTrainerId))
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('trainer.classes.members', $class) }}"
                                                       class="inline-flex items-center px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-white text-xs font-medium rounded-xl transition-all duration-200 border border-neutral-600 hover:border-neutral-500 shadow-sm hover:shadow-md">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                                        </svg>
                                                        Members
                                                    </a>
                                                    <a href="{{ route('trainer.classes.edit', $class) }}"
                                                       class="inline-flex items-center px-4 py-2 bg-[#ADFF2F] hover:bg-[#9FE529] text-black text-xs font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-lg">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('trainer.classes.destroy', $class) }}"
                                                          method="POST"
                                                          class="inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this class?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-4 py-2 bg-red-600/90 hover:bg-red-600 text-white text-xs font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-lg">
                                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-neutral-700 text-neutral-400">
                                                    No actions
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="px-6 py-5 border-t border-neutral-700 bg-neutral-900/30">
                        {{ $classes->links() }}
                    </div>
                @else
                    <div class="p-16 text-center">
                        <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6" style="background: rgba(173,255,47,0.1);">
                            <svg class="w-10 h-10" style="color:#ADFF2F;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">No classes found</h3>
                        <p class="text-neutral-400 mb-6">Get started by creating your first class.</p>
                        <a href="{{ route('trainer.classes.create') }}"
                           class="inline-flex items-center px-6 py-3 bg-[#ADFF2F] hover:bg-[#9FE529] text-black font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create Your First Class
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
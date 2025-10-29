<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Select Class for Attendance') }}
            </h2>
            <a href="{{ route('trainer.attendance.view_all') }}" class="inline-flex items-center px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-neutral-600 transition duration-200">
                View All Records
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="bg-red-900 border border-red-700 text-red-200 px-4 py-3 rounded-lg mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" style="color:#ff6b6b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($classes as $class)
                    <div class="bg-neutral-800 overflow-hidden shadow-xl sm:rounded-lg border border-neutral-700 hover:bg-neutral-750 transition duration-200">
                        <div class="p-6 bg-neutral-800 border-b border-neutral-700">
                            <h3 class="text-lg font-semibold text-white mb-2">{{ $class->nama_kelas }}</h3>
                            <p class="text-neutral-400 mb-4">{{ $class->deskripsi }}</p>
                            <div class="text-sm text-neutral-400 space-y-1 mb-4">
                                <p><span class="font-medium text-white">Schedule:</span> {{ $class->waktu_mulai->format('H:i') }} - {{ $class->waktu_selesai->format('H:i') }}</p>
                                <p><span class="font-medium text-white">Duration:</span> {{ $class->durasi }} minutes</p>
                                <p><span class="font-medium text-white">Members:</span> {{ $class->bookings->count() }} / {{ $class->kapasitas }}</p>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('trainer.attendance.track', ['class' => $class->class_id]) }}"
                                   class="inline-flex items-center px-4 py-2 bg-[#ADFF2F] border border-transparent rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-[#9FE529] transition duration-200">
                                    Take Attendance
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3">
                        <div class="bg-neutral-800 overflow-hidden shadow-xl sm:rounded-lg border border-neutral-700">
                            <div class="p-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-white">No classes found</h3>
                                <p class="mt-1 text-sm text-neutral-400">Please check your class assignments.</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
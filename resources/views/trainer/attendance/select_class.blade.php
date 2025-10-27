<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Select Class for Attendance') }}
            </h2>
            <a href="{{ route('trainer.attendance.view_all') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                View All Records
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($classes as $class)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $class->nama_kelas }}</h3>
                            <p class="text-gray-600 mb-4">{{ $class->deskripsi }}</p>
                            <div class="text-sm text-gray-500 space-y-1 mb-4">
                                <p><span class="font-medium">Schedule:</span> {{ $class->waktu_mulai->format('H:i') }} - {{ $class->waktu_selesai->format('H:i') }}</p>
                                <p><span class="font-medium">Duration:</span> {{ $class->durasi }} minutes</p>
                                <p><span class="font-medium">Members:</span> {{ $class->bookings->count() }} / {{ $class->kapasitas }}</p>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('trainer.attendance.track', ['class' => $class->class_id]) }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    Take Attendance
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-500 text-center">
                                No classes found. Please check your class assignments.
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
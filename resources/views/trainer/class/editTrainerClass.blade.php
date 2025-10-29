<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Edit Class
        </h2>
    </x-slot>

    <div class="py-12 bg-black min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="bg-neutral-800 p-6 shadow sm:rounded-lg mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(173,255,47,0.1); color:#ADFF2F;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">Edit Class</h1>
                            <p class="text-neutral-400">Update class information</p>
                        </div>
                    </div>
                    <a href="{{ route('trainer.classes.index') }}" class="px-4 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium flex items-center space-x-2 transition duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Back</span>
                    </a>
                </div>
            </div>

            @if ($errors->any())
            <div class="mb-4 p-4 rounded-lg bg-red-500/20 border border-red-500/30">
                <ul class="list-disc list-inside text-red-400 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Form --}}
            <div class="bg-neutral-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('trainer.classes.update', $gymClass->class_id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_kelas" class="block text-sm font-medium text-white mb-2">Nama Kelas</label>
                            <input type="text" name="nama_kelas" id="nama_kelas" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('nama_kelas', $gymClass->nama_kelas) }}" required placeholder="e.g. Yoga Class">
                        </div>
                        <div>
                            <label for="kapasitas" class="block text-sm font-medium text-white mb-2">Kapasitas</label>
                            <input type="number" name="kapasitas" id="kapasitas" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('kapasitas', $gymClass->kapasitas) }}" required placeholder="e.g. 20">
                        </div>
                        <div>
                            <label for="waktu_mulai" class="block text-sm font-medium text-white mb-2">Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" id="waktu_mulai" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('waktu_mulai', $gymClass->waktu_mulai ? \Carbon\Carbon::parse($gymClass->waktu_mulai)->format('H:i') : '') }}" required>
                        </div>
                        <div>
                            <label for="waktu_selesai" class="block text-sm font-medium text-white mb-2">Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" id="waktu_selesai" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('waktu_selesai', $gymClass->waktu_selesai ? \Carbon\Carbon::parse($gymClass->waktu_selesai)->format('H:i') : '') }}" required>
                        </div>
                        <div class="md:col-span-2">
                            <label for="durasi" class="block text-sm font-medium text-white mb-2">Durasi (menit)</label>
                            <input type="number" name="durasi" id="durasi" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('durasi', $gymClass->durasi) }}" required placeholder="e.g. 60">
                        </div>
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-white mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" required placeholder="Enter class description">{{ old('deskripsi', $gymClass->deskripsi) }}</textarea>
                    </div>

                    <div class="mt-8 flex items-center space-x-4">
                        <button type="submit" class="px-6 py-2 rounded-lg font-medium flex items-center space-x-2 text-black hover:bg-[#9FE529] transition-all duration-200" style="background-color:#ADFF2F;">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Update Class</span>
                        </button>
                        <a href="{{ route('trainer.classes.index') }}" class="px-6 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium transition duration-200">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

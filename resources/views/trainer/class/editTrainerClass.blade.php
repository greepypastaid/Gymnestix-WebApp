<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Edit Class
        </h2>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-neutral-800 overflow-hidden shadow-xl sm:rounded-lg border border-neutral-700">
                <div class="p-6 lg:p-8 bg-neutral-800 border-b border-neutral-700">
                    <form action="{{ route('trainer.classes.update', $gymClass) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Class Name -->
                        <div>
                            <label for="nama_kelas" class="block text-sm font-medium text-white mb-2">
                                Nama Kelas
                            </label>
                            <input
                                type="text"
                                id="nama_kelas"
                                name="nama_kelas"
                                value="{{ $gymClass->nama_kelas }}"
                                required
                                class="w-full px-4 py-3 border border-neutral-600 rounded-lg focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F] bg-neutral-700 text-white transition duration-200"
                                placeholder="Masukkan nama kelas"
                            />
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-white mb-2">
                                Deskripsi
                            </label>
                            <textarea
                                id="deskripsi"
                                name="deskripsi"
                                rows="4"
                                required
                                class="w-full px-4 py-3 border border-neutral-600 rounded-lg focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F] bg-neutral-700 text-white transition duration-200"
                                placeholder="Jelaskan tentang kelas ini..."
                            >{{ $gymClass->deskripsi }}</textarea>
                        </div>

                        <!-- Time Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="waktu_mulai" class="block text-sm font-medium text-white mb-2">
                                    Waktu Mulai
                                </label>
                                <input
                                    type="time"
                                    id="waktu_mulai"
                                    name="waktu_mulai"
                                    value="{{ $gymClass->waktu_mulai }}"
                                    required
                                    class="w-full px-4 py-3 border border-neutral-600 rounded-lg focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F] bg-neutral-700 text-white transition duration-200"
                                />
                            </div>

                            <div>
                                <label for="waktu_selesai" class="block text-sm font-medium text-white mb-2">
                                    Waktu Selesai
                                </label>
                                <input
                                    type="time"
                                    id="waktu_selesai"
                                    name="waktu_selesai"
                                    value="{{ $gymClass->waktu_selesai }}"
                                    required
                                    class="w-full px-4 py-3 border border-neutral-600 rounded-lg focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F] bg-neutral-700 text-white transition duration-200"
                                />
                            </div>
                        </div>

                        <!-- Duration and Capacity -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="durasi" class="block text-sm font-medium text-white mb-2">
                                    Durasi (menit)
                                </label>
                                <input
                                    type="number"
                                    id="durasi"
                                    name="durasi"
                                    min="1"
                                    value="{{ $gymClass->durasi }}"
                                    required
                                    class="w-full px-4 py-3 border border-neutral-600 rounded-lg focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F] bg-neutral-700 text-white transition duration-200"
                                    placeholder="60"
                                />
                            </div>

                            <div>
                                <label for="kapasitas" class="block text-sm font-medium text-white mb-2">
                                    Kapasitas
                                </label>
                                <input
                                    type="number"
                                    id="kapasitas"
                                    name="kapasitas"
                                    min="1"
                                    value="{{ $gymClass->kapasitas }}"
                                    required
                                    class="w-full px-4 py-3 border border-neutral-600 rounded-lg focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F] bg-neutral-700 text-white transition duration-200"
                                    placeholder="20"
                                />
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end pt-6 border-t border-neutral-700">
                            <a
                                href="{{ route('trainer.classes.index') }}"
                                class="inline-flex items-center px-4 py-2 mr-3 bg-neutral-600 hover:bg-neutral-500 text-white text-sm font-medium rounded-lg transition duration-200"
                            >
                                Cancel
                            </a>
                            <button
                                type="submit"
                                class="inline-flex items-center px-6 py-3 bg-[#ADFF2F] hover:bg-[#9FE529] text-black font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:ring-offset-2 transition duration-200"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Update Class
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
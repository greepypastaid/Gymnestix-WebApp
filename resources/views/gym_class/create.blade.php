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
                    <div class="title">Add New Gym Class</div>
                    <div class="subtitle">Create a new gym class schedule</div>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('gym_class.index') }}" class="px-4 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white rounded-lg font-medium transition-colors inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>

        @if ($errors->any())
        <div class="mb-6 card-dark border-l-4 border-red-500 p-4">
            <ul class="list-disc list-inside text-red-400 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <div class="card-dark p-6">
            <form action="{{ route('gym_class.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama_kelas" class="block text-gray-400 mb-2">Nama Kelas</label>
                        <input type="text" name="nama_kelas" id="nama_kelas" class="input-dark w-full" value="{{ old('nama_kelas') }}" required placeholder="e.g. Yoga Class">
                    </div>
                    <div>
                        <label for="trainer_id" class="block text-gray-400 mb-2">Trainer ID</label>
                        <input type="number" name="trainer_id" id="trainer_id" class="input-dark w-full" value="{{ old('trainer_id') }}" required placeholder="Enter trainer ID">
                    </div>
                    <div>
                        <label for="waktu_mulai" class="block text-gray-400 mb-2">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" id="waktu_mulai" class="input-dark w-full" value="{{ old('waktu_mulai') }}" required>
                    </div>
                    <div>
                        <label for="waktu_selesai" class="block text-gray-400 mb-2">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" id="waktu_selesai" class="input-dark w-full" value="{{ old('waktu_selesai') }}" required>
                    </div>
                    <div>
                        <label for="hari" class="block text-sm font-medium text-white mb-2">Hari</label>
                        <select name="hari" id="hari" class="input-dark w-full" required>
                            @php $days = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']; @endphp
                            <option value="" disabled selected>-- Pilih Hari --</option>
                            @foreach($days as $d)
                                <option value="{{ $d }}" {{ old('hari')===$d ? 'selected' : '' }}>{{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="durasi" class="block text-sm font-medium text-white mb-2">Durasi (menit)</label>
                        <input type="number" name="durasi" id="durasi" class="input-dark w-full" value="{{ old('durasi') }}" required placeholder="e.g. 60">
                    </div>
                    <div>
                        <label for="kapasitas" class="block text-sm font-medium text-white mb-2">Kapasitas</label>
                        <input type="number" name="kapasitas" id="kapasitas" class="input-dark w-full" value="{{ old('kapasitas') }}" required placeholder="e.g. 20">
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-white mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" class="input-dark w-full" required placeholder="Enter class description">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mt-8 flex items-center space-x-4">
                    <button type="submit" class="btn-primary-custom flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Create Gym Class</span>
                    </button>
                    <a href="{{ route('gym_class.index') }}" class="px-6 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium transition duration-200">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

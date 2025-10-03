<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Edit Class</h2></x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form action="{{ route('trainer.classes.update', $gymClass) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <div><label>Nama Kelas</label><input name="nama_kelas" value="{{ $gymClass->nama_kelas }}" required class="w-full" /></div>
            <div><label>Deskripsi</label><textarea name="deskripsi" required class="w-full">{{ $gymClass->deskripsi }}</textarea></div>
            <div><label>Waktu Mulai</label><input type="time" name="waktu_mulai" value="{{ $gymClass->waktu_mulai }}" required /></div>
            <div><label>Waktu Selesai</label><input type="time" name="waktu_selesai" value="{{ $gymClass->waktu_selesai }}" required /></div>
            <div><label>Durasi (menit)</label><input type="number" name="durasi" value="{{ $gymClass->durasi }}" required /></div>
            <div><label>Kapasitas</label><input type="number" name="kapasitas" value="{{ $gymClass->kapasitas }}" required /></div>
            <div><button class="px-3 py-1 bg-yellow-600 text-white rounded">Update</button></div>
        </form>
    </div>
</x-app-layout>
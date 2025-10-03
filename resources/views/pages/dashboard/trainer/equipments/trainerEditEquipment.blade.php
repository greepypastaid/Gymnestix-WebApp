<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Edit Equipment</h2></x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form action="{{ route('trainer.equipments.update', $equipments) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <div><label>Nama Alat</label><input name="nama_alat" value="{{ $equipments->nama_alat }}" required class="w-full" /></div>
            <div><label>Kondisi</label>
                <select name="kondisi" required>
                    <option value="Baik" {{ $equipments->kondisi === 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Perlu Perbaikan" {{ $equipments->kondisi === 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                </select>
            </div>
            <div><label>Tanggal Pembelian</label><input type="date" name="tanggal_pembelian" value="{{ $equipments->tanggal_pembelian?->format('Y-m-d') }}" required /></div>
            <div><label>Jadwal Perawatan</label><input type="date" name="jadwal_perawatan" value="{{ $equipments->jadwal_perawatan?->format('Y-m-d') }}" required /></div>
            <div><button class="px-3 py-1 bg-yellow-600 text-white rounded">Update</button></div>
        </form>
    </div>
</x-app-layout>
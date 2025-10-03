<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Create Equipment</h2></x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form action="{{ route('trainer.equipments.store') }}" method="POST" class="space-y-4">
            @csrf
            <div><label>Nama Alat</label><input name="nama_alat" required class="w-full" /></div>
            <div><label>Kondisi</label>
                <select name="kondisi" required>
                    <option value="Baik">Baik</option>
                    <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                </select>
            </div>
            <div><label>Tanggal Pembelian</label><input type="date" name="tanggal_pembelian" required /></div>
            <div><label>Jadwal Perawatan</label><input type="date" name="jadwal_perawatan" required /></div>
            <div><button class="px-3 py-1 bg-green-600 text-white rounded">Create</button></div>
        </form>
    </div>
</x-app-layout>
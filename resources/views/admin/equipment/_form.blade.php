@php $isEdit = $row && $row->exists; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
    <div>
        <label for="nama_alat" class="block text-xs sm:text-sm font-medium text-white mb-1.5 sm:mb-2">Equipment Name</label>
        <input type="text" id="nama_alat" name="nama_alat" class="block w-full px-3 py-2 text-sm border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" required
               value="{{ old('nama_alat', $row->nama_alat ?? '') }}" placeholder="Enter equipment name">
    </div>

    <div>
        <label for="kondisi" class="block text-xs sm:text-sm font-medium text-white mb-1.5 sm:mb-2">Condition</label>
        <select id="kondisi" name="kondisi" class="block w-full px-3 py-2 text-sm border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
            <option value="">Select condition</option>
            <option value="baru" {{ old('kondisi', $row->kondisi ?? '') == 'baru' ? 'selected' : '' }}>New</option>
            <option value="baik" {{ old('kondisi', $row->kondisi ?? '') == 'baik' ? 'selected' : '' }}>Good</option>
            <option value="cukup" {{ old('kondisi', $row->kondisi ?? '') == 'cukup' ? 'selected' : '' }}>Fair</option>
            <option value="rusak" {{ old('kondisi', $row->kondisi ?? '') == 'rusak' ? 'selected' : '' }}>Damaged</option>
        </select>
    </div>

    <div>
        <label for="tanggal_pembelian" class="block text-xs sm:text-sm font-medium text-white mb-1.5 sm:mb-2">Purchase Date</label>
        <input type="date" id="tanggal_pembelian" name="tanggal_pembelian" class="block w-full px-3 py-2 text-sm border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
               value="{{ old('tanggal_pembelian', optional($row->tanggal_pembelian ?? null)->format('Y-m-d')) }}">
    </div>

    <div>
        <label for="jadwal_perawatan" class="block text-xs sm:text-sm font-medium text-white mb-1.5 sm:mb-2">Maintenance Schedule</label>
        <input type="date" id="jadwal_perawatan" name="jadwal_perawatan" class="block w-full px-3 py-2 text-sm border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
               value="{{ old('jadwal_perawatan', optional($row->jadwal_perawatan ?? null)->format('Y-m-d')) }}">
    </div>
</div>

<div class="mt-6 sm:mt-8 flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-2 sm:space-y-0">
    <button type="submit" class="w-full sm:w-auto px-5 py-2 text-sm sm:text-base rounded-lg font-medium flex items-center justify-center sm:justify-start space-x-2 text-black hover:bg-green-400 transition-all duration-200" style="background-color:#ADFF2F;">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span>{{ $isEdit ? 'Update Equipment' : 'Create Equipment' }}</span>
    </button>
    <a href="{{ route('admin.equipment.index') }}" class="w-full sm:w-auto text-center px-6 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium transition duration-200">Cancel</a>
</div>

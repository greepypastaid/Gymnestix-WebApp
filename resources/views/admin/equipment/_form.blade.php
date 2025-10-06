@php $isEdit = $row && $row->exists; @endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
  <div>
    <label for="nama_alat" class="block text-sm font-medium text-gray-700 mb-2">Equipment Name</label>
    <input type="text" id="nama_alat" name="nama_alat" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required
           value="{{ old('nama_alat', $row->nama_alat ?? '') }}" placeholder="Enter equipment name">
  </div>

  <div>
    <label for="kondisi" class="block text-sm font-medium text-gray-700 mb-2">Condition</label>
    <select id="kondisi" name="kondisi" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
      <option value="">Select condition</option>
      <option value="baru" {{ old('kondisi', $row->kondisi ?? '') == 'baru' ? 'selected' : '' }}>New</option>
      <option value="baik" {{ old('kondisi', $row->kondisi ?? '') == 'baik' ? 'selected' : '' }}>Good</option>
      <option value="cukup" {{ old('kondisi', $row->kondisi ?? '') == 'cukup' ? 'selected' : '' }}>Fair</option>
      <option value="rusak" {{ old('kondisi', $row->kondisi ?? '') == 'rusak' ? 'selected' : '' }}>Damaged</option>
    </select>
  </div>

  <div>
    <label for="tanggal_pembelian" class="block text-sm font-medium text-gray-700 mb-2">Purchase Date</label>
    <input type="date" id="tanggal_pembelian" name="tanggal_pembelian" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
           value="{{ old('tanggal_pembelian', optional($row->tanggal_pembelian ?? null)->format('Y-m-d')) }}">
  </div>

  <div>
    <label for="jadwal_perawatan" class="block text-sm font-medium text-gray-700 mb-2">Maintenance Schedule</label>
    <input type="date" id="jadwal_perawatan" name="jadwal_perawatan" class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
           value="{{ old('jadwal_perawatan', optional($row->jadwal_perawatan ?? null)->format('Y-m-d')) }}">
  </div>
</div>

<div class="mt-8 flex items-center space-x-4">
  <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium flex items-center space-x-2 transition duration-200">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
    </svg>
    <span>{{ $isEdit ? 'Update Equipment' : 'Create Equipment' }}</span>
  </button>
  <a href="{{ route('admin.equipment.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg font-medium transition duration-200">Cancel</a>
</div>

@php $isEdit = $row && $row->exists; @endphp

<div class="row g-3">
  <div class="col-12 col-md-6">
    <label class="form-label">Nama Alat</label>
    <input type="text" name="nama_alat" class="form-control" required
           value="{{ old('nama_alat', $row->nama_alat) }}">
  </div>

  <div class="col-12 col-md-6">
    <label class="form-label">Kondisi</label>
    <input type="text" name="kondisi" class="form-control"
           placeholder="mis. baru / baik / cukup / rusak"
           value="{{ old('kondisi', $row->kondisi) }}" required>
  </div>

  <div class="col-12 col-md-6">
    <label class="form-label">Tanggal Pembelian</label>
    <input type="date" name="tanggal_pembelian" class="form-control"
           value="{{ old('tanggal_pembelian', optional($row->tanggal_pembelian)->format('Y-m-d')) }}">
  </div>

  <div class="col-12 col-md-6">
    <label class="form-label">Jadwal Perawatan</label>
    <input type="date" name="jadwal_perawatan" class="form-control"
           value="{{ old('jadwal_perawatan', optional($row->jadwal_perawatan)->format('Y-m-d')) }}">
  </div>
</div>

<div class="mt-3 d-flex gap-2">
  <button class="btn btn-primary">{{ $isEdit ? 'Update' : 'Create' }}</button>
  <a href="{{ route('admin.equipment.index') }}" class="btn btn-light">Cancel</a>
</div>

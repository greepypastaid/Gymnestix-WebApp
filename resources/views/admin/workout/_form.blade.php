<div class="row g-3">
  <div class="col-12 col-md-5">
    <label class="form-label">Member</label>
    <select name="member_id" class="form-select" required>
      <option value="">-- Pilih Member --</option>
      @foreach($members as $m)
        @php
          $label = $m->user?->nama ?: ($m->nama ?? ('Member#'.$m->member_id));
          $email = $m->user?->email ?? '';
        @endphp
        <option value="{{ $m->member_id }}" @selected(old('member_id', $row->member_id ?? '') == $m->member_id)>
          {{ $label }} @if($email) — {{ $email }} @endif
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-12 col-md-3">
    <label class="form-label">Tanggal</label>
    <input type="date" name="tanggal" class="form-control" required
           value="{{ old('tanggal', optional($row->tanggal)->format('Y-m-d')) }}">
  </div>

  <div class="col-12 col-md-4">
    <label class="form-label">Jenis Latihan</label>
    <input type="text" name="jenis_latihan" class="form-control" required
           value="{{ old('jenis_latihan', $row->jenis_latihan) }}" placeholder="mis. Bench Press">
  </div>

  <div class="col-4 col-md-2">
    <label class="form-label">Repetisi</label>
    <input type="number" min="0" name="catatan_repetisi" class="form-control"
           value="{{ old('catatan_repetisi', $row->catatan_repetisi) }}">
  </div>
  <div class="col-4 col-md-2">
    <label class="form-label">Durasi (menit)</label>
    <input type="number" min="0" name="catatan_durasi" class="form-control"
           value="{{ old('catatan_durasi', $row->catatan_durasi) }}">
  </div>
  <div class="col-4 col-md-2">
    <label class="form-label">Berat (kg)</label>
    <input type="number" step="0.01" min="0" name="catatan_berat" class="form-control"
           value="{{ old('catatan_berat', $row->catatan_berat) }}">
  </div>

  <div class="col-12 d-flex gap-2">
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.workouts.index') }}" class="btn btn-outline-secondary">Batal</a>
  </div>
</div>

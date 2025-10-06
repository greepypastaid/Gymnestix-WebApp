@extends('layouts.app')

@section('content')
<style>
  .control-card{border:1px solid rgba(0,0,0,.08); border-radius:.75rem; padding:.75rem .9rem; background:#fff}
  .control-card .label{font-size:.8rem; color:#6c757d; margin-bottom:.35rem; font-weight:600; letter-spacing:.2px}
  .soft-card{border:1px solid rgba(0,0,0,.08); border-radius:.9rem; background:#fff}
  .icon-pill{width:42px;height:42px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center}
</style>

<div class="container py-4">
  {{-- Header --}}
  <div class="d-flex align-items-center justify-content-between mb-3">
    <div class="d-flex align-items-center gap-3">
      <div class="icon-pill bg-primary-subtle text-primary"><i class="bi bi-tools"></i></div>
      <div>
        <h5 class="mb-0 fw-semibold">Equipment</h5>
        <div class="text-muted small">Kelola data alat gym</div>
      </div>
    </div>
    @can('equipment.manage')
    <a href="{{ route('admin.equipment.create') }}" class="btn btn-primary">
      <i class="bi bi-plus-lg me-1"></i> Tambah Alat
    </a>
    @endcan
  </div>

  @if(session('ok')) <div class="alert alert-success">{{ session('ok') }}</div> @endif

  {{-- Filter --}}
  <div class="soft-card mb-3">
    <div class="p-3 border-bottom small fw-semibold text-muted">
      <i class="bi bi-funnel me-1"></i> Filter
    </div>
    <div class="p-3">
      <form method="GET" action="{{ route('admin.equipment.index') }}" class="row g-3 align-items-end">
        <div class="col-12 col-md-4">
          <div class="control-card h-100">
            <div class="label">Cari</div>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-search"></i></span>
              <input type="text" name="q" class="form-control" value="{{ $q ?? '' }}" placeholder="Nama alat">
            </div>
          </div>
        </div>
        <div class="col-6 col-md-2">
          <div class="control-card h-100">
            <div class="label">Kondisi</div>
            <input type="text" name="kondisi" class="form-control" value="{{ $kondisi ?? '' }}" placeholder="mis. baik">
          </div>
        </div>
        <div class="col-6 col-md-2">
          <div class="control-card h-100">
            <div class="label">Dari Tgl Beli</div>
            <input type="date" name="from" class="form-control" value="{{ $dateFrom ?? '' }}">
          </div>
        </div>
        <div class="col-6 col-md-2">
          <div class="control-card h-100">
            <div class="label">Sampai Tgl Beli</div>
            <input type="date" name="to" class="form-control" value="{{ $dateTo ?? '' }}">
          </div>
        </div>
        <div class="col-6 col-md-2">
          <div class="control-card h-100 d-grid">
            <div class="label">&nbsp;</div>
            <button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i> Terapkan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  {{-- Table --}}
  <div class="soft-card">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead class="table-light">
          <tr class="text-muted small">
            <th class="ps-4">Nama Alat</th>
            <th>Kondisi</th>
            <th>Tanggal Pembelian</th>
            <th>Jadwal Perawatan</th>
            <th>Peminjaman</th>
            <th class="text-end pe-4">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($rows as $r)
          <tr>
            <td class="ps-4 fw-semibold">{{ $r->nama_alat }}</td>
            <td><span class="badge text-bg-secondary">{{ $r->kondisi ?: '—' }}</span></td>
            <td>{{ $r->tanggal_pembelian?->format('d M Y') ?? '—' }}</td>
            <td>{{ $r->jadwal_perawatan?->format('d M Y') ?? '—' }}</td>
            <td>{{ $r->peminjamans_count ?? 0 }}</td>
            <td class="text-end pe-4">
              @can('equipment.manage')
              <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.equipment.edit', $r->equipment_id) }}">
                <i class="bi bi-pencil-square"></i>
              </a>
              <form action="{{ route('admin.equipment.destroy', $r->equipment_id) }}" method="post" class="d-inline"
                    onsubmit="return confirm('Hapus alat ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3"></i></button>
              </form>
              @else
              <span class="text-muted small">No action</span>
              @endcan
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center py-5">
              <div class="py-2">
                <div class="mb-2"><i class="bi bi-inboxes" style="font-size:32px"></i></div>
                <div class="fw-semibold mb-1">Belum ada data</div>
                <div class="text-muted small mb-3">Tambah data alat terlebih dahulu</div>
                @can('equipment.manage')
                <a href="{{ route('admin.equipment.create') }}" class="btn btn-sm btn-primary">
                  <i class="bi bi-plus-lg me-1"></i> Tambah Alat
                </a>
                @endcan
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($rows->hasPages())
      <div class="p-3 d-flex justify-content-end">
        {{ $rows->links() }}
      </div>
    @endif
  </div>
</div>
@endsection

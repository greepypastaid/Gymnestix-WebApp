@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
    <h2 class="fw-bold mb-4">Tambah Pembayaran</h2>
    <form action="{{ route('billing.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="member_id" class="form-label">Member</label>
            <select name="member_id" id="member_id" class="form-control" required>
                <option value="">-- Pilih Member --</option>
                @forelse($members as $member)
                    <option value="{{ $member->member_id }}">{{ $member->user ? $member->user->nama : 'Member #' . $member->member_id }}</option>
                @empty
                    <option value="">Tidak ada member terdaftar</option>
                @endforelse
            </select>
        </div>
        <div class="mb-3">
            <label for="plan_id" class="form-label">Plan</label>
            <select name="plan_id" id="plan_id" class="form-control" required onchange="updateJumlah()">
                <option value="">-- Pilih Plan --</option>
                @foreach($plans as $plan)
                    <option value="{{ $plan->plan_id }}" data-harga="{{ $plan->harga }}">{{ $plan->nama_plan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
        </div>
        <script>
        function updateJumlah() {
            var select = document.getElementById('plan_id');
            var harga = select.options[select.selectedIndex].getAttribute('data-harga');
            document.getElementById('jumlah').value = harga ? harga : '';
        }
        </script>
        <div class="mb-3">
            <label for="tanggal_tagihan" class="form-label">Tanggal Tagihan</label>
            <input type="date" name="tanggal_tagihan" id="tanggal_tagihan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_jatuh_tempo" class="form-label">Tanggal Jatuh Tempo</label>
            <input type="date" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
            <input type="text" name="status_pembayaran" id="status_pembayaran" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('billing.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

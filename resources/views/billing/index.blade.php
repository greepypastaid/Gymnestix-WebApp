@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
    <h2 class="fw-bold mb-4">Daftar Pembayaran</h2>
    <a href="{{ route('billing.create') }}" class="btn btn-success mb-3">Tambah Pembayaran</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama User</th>
                <th>Nama Plan</th>
                <th>Jumlah</th>
                <th>Tanggal Tagihan</th>
                <th>Tanggal Jatuh Tempo</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($billings as $billing)
            <tr>
                <td>{{ $billing->member && $billing->member->user ? $billing->member->user->nama : '-' }}</td>
                <td>{{ $billing->membershipPlan ? $billing->membershipPlan->nama_plan : '-' }}</td>
                <td>{{ $billing->jumlah }}</td>
                <td>{{ $billing->tanggal_tagihan }}</td>
                <td>{{ $billing->tanggal_jatuh_tempo }}</td>
                <td>{{ $billing->status_pembayaran }}</td>
                <td>
                    @if($billing->billing_id)
                        <a href="{{ route('billing.show', $billing->billing_id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('billing.edit', $billing->billing_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('billing.destroy', $billing->billing_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus pembayaran?')">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

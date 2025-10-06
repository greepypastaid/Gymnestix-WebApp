@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Daftar Membership Plan</h2>
    <a href="{{ route('membership_plan.create') }}" class="btn btn-success mb-3">Tambah Plan</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Plan</th>
                <th>Harga</th>
                <th>Durasi (bulan)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plans as $plan)
                <tr>
                    <td>{{ $plan->nama_plan }}</td>
                    <td>{{ $plan->harga }}</td>
                    <td>{{ $plan->periode_bulan }}</td>
                    <td>
                        @if($plan->plan_id)
                            <a href="{{ route('membership_plan.show', $plan->plan_id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('membership_plan.edit', $plan->plan_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('membership_plan.destroy', $plan->plan_id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus plan?')">Hapus</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

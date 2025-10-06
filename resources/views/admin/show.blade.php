@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Detail User/Member</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $user->nama }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Alamat:</strong> {{ $user->alamat }}</p>
            <p><strong>Nomor Telepon:</strong> {{ $user->nomor_telepon }}</p>
            <p><strong>Tanggal Lahir:</strong> {{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d/m/Y') : '-' }}</p>
            <p><strong>Role:</strong> 
                @if($user->role_id == 1)
                    Admin
                @elseif($user->role_id == 2)
                    Member
                @elseif($user->role_id == 3)
                    Trainer
                @else
                    -
                @endif
            </p>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection

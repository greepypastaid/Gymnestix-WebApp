@extends('layouts.app')

@section('content')
<div class="py-12 bg-black">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-neutral-800 p-6 shadow sm:rounded-lg text-white">
            <h2 class="fw-bold mb-4 text-white">Detail User/Member</h2>
            <div class="space-y-4">
                <div class="flex">
                    <span class="font-semibold text-white w-48">Nama:</span>
                    <span class="text-white">{{ $user->nama }}</span>
                </div>
                <div class="flex">
                    <span class="font-semibold text-white w-48">Email:</span>
                    <span class="text-white">{{ $user->email }}</span>
                </div>
                <div class="flex">
                    <span class="font-semibold text-white w-48">Alamat:</span>
                    <span class="text-white">{{ $user->alamat }}</span>
                </div>
                <div class="flex">
                    <span class="font-semibold text-white w-48">Nomor Telepon:</span>
                    <span class="text-white">{{ $user->nomor_telepon }}</span>
                </div>
                <div class="flex">
                    <span class="font-semibold text-white w-48">Tanggal Lahir:</span>
                    <span class="text-white">{{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d/m/Y') : '-' }}</span>
                </div>
                <div class="flex">
                    <span class="font-semibold text-white w-48">Role:</span>
                    <span class="text-white">
                        @if($user->role_id == 1)
                            Admin
                        @elseif($user->role_id == 2)
                            Member
                        @elseif($user->role_id == 3)
                            Trainer
                        @else
                            -
                        @endif
                    </span>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-neutral-600 text-white rounded-md hover:bg-neutral-500">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection

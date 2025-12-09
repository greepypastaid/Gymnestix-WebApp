@extends('layouts.app')

@section('content')
<div class="py-6 sm:py-12 bg-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-neutral-800 p-4 sm:p-6 shadow sm:rounded-lg text-white">
            <h2 class="fw-bold mb-4 text-white">Detail User/Member</h2>
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-6">
                    <div>
                        <div class="text-xs text-neutral-400">Nama</div>
                        <div class="font-semibold text-white">{{ $user->nama }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-neutral-400">Email</div>
                        <div class="text-white">{{ $user->email }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-6">
                    <div>
                        <div class="text-xs text-neutral-400">Alamat</div>
                        <div class="text-white">{{ $user->alamat }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-neutral-400">Nomor Telepon</div>
                        <div class="text-white">{{ $user->nomor_telepon }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-6">
                    <div>
                        <div class="text-xs text-neutral-400">Tanggal Lahir</div>
                        <div class="text-white">{{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d/m/Y') : '-' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-neutral-400">Role</div>
                        <div class="text-white">
                            @if($user->role_id == 1)
                                Admin
                            @elseif($user->role_id == 2)
                                Member
                            @elseif($user->role_id == 3)
                                Trainer
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-neutral-600 text-white rounded-md hover:bg-neutral-500">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection

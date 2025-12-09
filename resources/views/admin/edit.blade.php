@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto space-y-6">
        {{-- Header --}}
        <div class="card-header">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                    <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <div>
                    <div class="title">Edit User</div>
                    <div class="subtitle">Update user information</div>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('admin.index') }}" class="px-4 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white rounded-lg font-medium transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>

        @if ($errors->any())
        <div class="card-dark p-4 border-l-4 border-red-500">
            <ul class="list-disc list-inside text-red-400 space-y-1">
                @foreach ($errors->all() as $error)
                <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <div class="card-dark p-6">
            <form action="{{ route('admin.update', $user->user_id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-white mb-2">Nama</label>
                        <input type="text" name="nama" id="nama" class="input-dark w-full" value="{{ old('nama', $user->nama) }}" required placeholder="Enter full name">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-white mb-2">Email</label>
                        <input type="email" name="email" id="email" class="input-dark w-full" value="{{ old('email', $user->email) }}" required placeholder="user@example.com">
                    </div>
                    <div>
                        <label for="nomor_telepon" class="block text-sm font-medium text-white mb-2">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" id="nomor_telepon" class="input-dark w-full" value="{{ old('nomor_telepon', $user->nomor_telepon) }}" required placeholder="08123456789">
                    </div>
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-white mb-2">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="input-dark w-full" value="{{ old('tanggal_lahir', $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('Y-m-d') : '') }}" required>
                    </div>
                    <div>
                        <label for="role_id" class="block text-sm font-medium text-white mb-2">Role</label>
                        <select name="role_id" id="role_id" class="input-dark w-full" required>
                            <option value="">Select role</option>
                            <option value="1" {{ old('role_id', $user->role_id) == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ old('role_id', $user->role_id) == 2 ? 'selected' : '' }}>Member</option>
                            <option value="3" {{ old('role_id', $user->role_id) == 3 ? 'selected' : '' }}>Trainer</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="alamat" class="block text-sm font-medium text-white mb-2">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" class="input-dark w-full" required placeholder="Enter full address">{{ old('alamat', $user->alamat) }}</textarea>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="btn-primary-custom flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update User
                    </button>
                    <a href="{{ route('admin.index') }}" class="px-6 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white rounded-lg font-medium transition">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
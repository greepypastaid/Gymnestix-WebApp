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
                    <div class="title">User Details</div>
                    <div class="subtitle">View user information</div>
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

        {{-- User Info Card --}}
        <div class="card-dark p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-1">
                    <div class="text-sm text-gray-400">Nama</div>
                    <div class="text-lg font-semibold text-white">{{ $user->nama }}</div>
                </div>
                <div class="space-y-1">
                    <div class="text-sm text-gray-400">Email</div>
                    <div class="text-lg text-white">{{ $user->email }}</div>
                </div>
                <div class="space-y-1">
                    <div class="text-sm text-gray-400">Nomor Telepon</div>
                    <div class="text-lg text-white">{{ $user->nomor_telepon }}</div>
                </div>
                <div class="space-y-1">
                    <div class="text-sm text-gray-400">Tanggal Lahir</div>
                    <div class="text-lg text-white">{{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d/m/Y') : '-' }}</div>
                </div>
                <div class="space-y-1">
                    <div class="text-sm text-gray-400">Role</div>
                    <div class="text-lg">
                        @if($user->role_id == 1)
                            <span class="px-3 py-1 bg-purple-500/20 text-purple-400 rounded-lg text-sm font-medium">Admin</span>
                        @elseif($user->role_id == 2)
                            <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-lg text-sm font-medium">Member</span>
                        @elseif($user->role_id == 3)
                            <span class="px-3 py-1 bg-[#ADFF2F]/20 text-[#ADFF2F] rounded-lg text-sm font-medium">Trainer</span>
                        @else
                            <span class="text-white">-</span>
                        @endif
                    </div>
                </div>
                <div class="space-y-1 md:col-span-2">
                    <div class="text-sm text-gray-400">Alamat</div>
                    <div class="text-lg text-white">{{ $user->alamat }}</div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="mt-8 pt-6 border-t border-[#2a2a2a] flex items-center gap-3">
                <a href="{{ route('admin.edit', $user->user_id) }}" class="btn-primary-custom flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit User
                </a>
                <form action="{{ route('admin.destroy', $user->user_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 bg-red-500/10 hover:bg-red-500/20 text-red-400 rounded-lg font-medium transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

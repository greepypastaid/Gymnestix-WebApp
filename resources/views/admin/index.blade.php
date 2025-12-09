@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto space-y-6">
        <!-- Success Message -->
        @if(session('success'))
            <div class="card-dark p-4 border-l-4 border-[#ADFF2F]">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-lg bg-[#ADFF2F]/10 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="font-medium text-white">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Header -->
        <div class="card-header">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                    <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
                <div>
                    <div class="title">User Management</div>
                    <div class="subtitle">Manage all system users and members</div>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('admin.create') }}" class="btn-primary-custom inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add User
            </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="card-dark p-4">
            <form method="GET" action="{{ route('admin.index') }}" class="flex gap-3">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or phone..." class="input-dark w-full pl-10 pr-4 py-2.5">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <button type="submit" class="btn-primary-custom px-6">Search</button>
                @if(request('search'))
                    <a href="{{ route('admin.index') }}" class="btn-secondary px-6">Clear</a>
                @endif
            </form>
        </div>

        <!-- Users Table -->
        <div class="card-dark overflow-hidden">
            <!-- Mobile View -->
            <div class="md:hidden divide-y divide-[#2a2a2a]">
                @foreach($users as $user)
                    <div class="p-4">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 rounded-full bg-[#ADFF2F]/10 flex items-center justify-center text-[#ADFF2F] font-bold mr-3">
                                {{ substr($user->nama, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-semibold text-white">{{ $user->nama }}</div>
                                <div class="text-xs text-gray-400">{{ $user->email }}</div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.show', $user->user_id) }}" class="flex-1 text-center px-3 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white text-xs font-medium rounded-lg transition">
                                View
                            </a>
                            <a href="{{ route('admin.edit', $user->user_id) }}" class="flex-1 text-center px-3 py-2 bg-[#ADFF2F] hover:bg-[#9DE626] text-black text-xs font-semibold rounded-lg transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.destroy', $user->user_id) }}" method="POST" onsubmit="return confirm('Delete user?')" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-3 py-2 bg-red-600/20 hover:bg-red-600/30 text-red-400 text-xs font-semibold rounded-lg transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="table-minimal">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="hover:bg-neutral-700/20 transition duration-150">
                                <td>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-[#ADFF2F]/10 flex items-center justify-center text-[#ADFF2F] font-bold mr-3">
                                            {{ substr($user->nama, 0, 1) }}
                                        </div>
                                        <span class="text-sm font-medium text-white">{{ $user->nama }}</span>
                                    </div>
                                </td>
                                <td class="muted">
                                    <span class="text-sm">{{ $user->email }}</span>
                                </td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.show', $user->user_id) }}" class="px-4 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white text-xs font-medium rounded-lg transition">
                                            View
                                        </a>
                                        <a href="{{ route('admin.edit', $user->user_id) }}" class="px-4 py-2 btn-primary-custom text-black text-xs font-semibold rounded-lg transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.destroy', $user->user_id) }}" method="POST" onsubmit="return confirm('Delete user?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-4 py-2 bg-red-600/20 hover:bg-red-600/30 text-red-400 text-xs font-semibold rounded-lg transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="mt-6">
                    <x-pagination :paginator="$users" />
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
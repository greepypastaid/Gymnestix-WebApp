@extends('layouts.app')

@section('content')
<div class="py-6 sm:py-12 bg-black min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4 sm:space-y-8">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-neutral-800 p-3 sm:p-6 border-l-4 border-[#ADFF2F] rounded-lg sm:rounded-2xl text-white shadow-xl">
                <div class="flex items-center">
                    <div class="w-8 h-8 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl flex items-center justify-center mr-3 sm:mr-4" style="background: rgba(173,255,47,0.1);">
                        <svg class="w-4 h-4 sm:w-6 sm:h-6" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Header with Action -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 sm:gap-4">
            <div>
                <h1 class="text-xl sm:text-3xl font-bold text-white">User Management</h1>
                <p class="mt-0.5 sm:mt-1 text-xs sm:text-base text-neutral-400">Manage all system users and members</p>
            </div>
            <a href="{{ route('admin.create') }}"
               class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-[#ADFF2F] hover:bg-[#9FE529] text-black text-sm sm:text-base font-semibold rounded-lg sm:rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 w-full sm:w-auto">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah User
            </a>
        </div>

        <!-- Users Table (desktop) & Mobile Cards -->
        <div class="bg-neutral-800 rounded-lg sm:rounded-2xl shadow-2xl overflow-hidden border border-neutral-700">
            <!-- Mobile: stacked cards -->
            <div class="md:hidden space-y-3 p-3">
                @foreach($users as $user)
                    <div class="bg-neutral-900/40 p-3 rounded-lg border border-neutral-700">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center mr-2.5" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                    <span class="text-black font-bold text-xs">{{ substr($user->nama, 0, 1) }}</span>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-white leading-tight">{{ $user->nama }}</div>
                                    <div class="text-xs text-neutral-400 mt-0.5">{{ $user->email }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2.5 flex gap-1.5">
                            <a href="{{ route('admin.show', $user->user_id) }}" class="flex-1 text-center px-2.5 py-1.5 bg-neutral-700 hover:bg-neutral-600 text-white text-xs font-medium rounded-md transition">Detail</a>
                            <a href="{{ route('admin.edit', $user->user_id) }}" class="flex-1 text-center px-2.5 py-1.5 bg-[#ADFF2F] hover:bg-[#9FE529] text-black text-xs font-semibold rounded-md transition">Edit</a>
                            <form action="{{ route('admin.destroy', $user->user_id) }}" method="POST" onsubmit="return confirm('Yakin hapus user?')" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full text-center px-2.5 py-1.5 bg-red-600/90 hover:bg-red-600 text-white text-xs font-semibold rounded-md transition">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop: table view -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-700">
                    <thead class="bg-neutral-900/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                User
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-neutral-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-700/50">
                        @foreach($users as $user)
                            <tr class="hover:bg-neutral-700/30 transition duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3" style="background: linear-gradient(135deg, #ADFF2F 0%, #7CB518 100%);">
                                            <span class="text-black font-bold text-sm">{{ substr($user->nama, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-white">{{ $user->nama }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center text-sm text-neutral-300">
                                        <svg class="w-4 h-4 mr-2 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $user->email }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.show', $user->user_id) }}"
                                           class="inline-flex items-center px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-white text-xs font-medium rounded-xl transition-all duration-200 border border-neutral-600 hover:border-neutral-500 shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.edit', $user->user_id) }}"
                                           class="inline-flex items-center px-4 py-2 bg-[#ADFF2F] hover:bg-[#9FE529] text-black text-xs font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-lg">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.destroy', $user->user_id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus user?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 bg-red-600/90 hover:bg-red-600 text-white text-xs font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-lg">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
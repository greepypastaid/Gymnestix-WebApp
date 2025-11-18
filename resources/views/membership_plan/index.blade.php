@extends('layouts.app')

@section('content')
<div class="py-12 bg-black min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-neutral-800 p-6 border-l-4 border-[#ADFF2F] rounded-2xl text-white shadow-xl">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-4" style="background: rgba(173,255,47,0.1);">
                        <svg class="w-6 h-6" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Header with Action -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-white">Membership Plans</h1>
                <p class="mt-1 text-neutral-400">Manage gym membership packages and pricing</p>
            </div>
            <a href="{{ route('membership_plan.create') }}"
               class="inline-flex items-center px-6 py-3 bg-[#ADFF2F] hover:bg-[#9FE529] text-black font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Plan
            </a>
        </div>

        <!-- Plans Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($plans as $plan)
                <div class="bg-neutral-800 rounded-2xl shadow-2xl overflow-hidden border border-neutral-700 hover:border-[#ADFF2F] transition-all duration-200 group">
                    <div class="p-6">
                        <!-- Plan Icon & Name -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center mr-3" style="background: rgba(173,255,47,0.1);">
                                    <svg class="w-6 h-6" style="color:#ADFF2F;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-white">{{ $plan->nama_plan }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <div class="flex items-baseline">
                                <span class="text-3xl font-bold text-[#ADFF2F]">Rp {{ number_format($plan->harga, 0, ',', '.') }}</span>
                            </div>
                            <p class="text-sm text-neutral-400 mt-1">per {{ $plan->periode_bulan }} bulan</p>
                        </div>

                        <!-- Duration Badge -->
                        <div class="mb-6">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-neutral-700 text-neutral-300">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $plan->periode_bulan }} Bulan
                            </span>
                        </div>

                        <!-- Actions -->
                        @if($plan->plan_id)
                            <div class="flex flex-col space-y-2">
                                <a href="{{ route('membership_plan.show', $plan->plan_id) }}"
                                   class="inline-flex items-center justify-center px-4 py-2 bg-neutral-700 hover:bg-neutral-600 text-white text-sm font-medium rounded-xl transition-all duration-200 border border-neutral-600 hover:border-neutral-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Details
                                </a>
                                <div class="flex space-x-2">
                                    <a href="{{ route('membership_plan.edit', $plan->plan_id) }}"
                                       class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-[#ADFF2F] hover:bg-[#9FE529] text-black text-sm font-semibold rounded-xl transition-all duration-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('membership_plan.destroy', $plan->plan_id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin hapus plan?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600/90 hover:bg-red-600 text-white text-sm font-semibold rounded-xl transition-all duration-200">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
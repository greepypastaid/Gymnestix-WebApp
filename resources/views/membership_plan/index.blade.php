@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto space-y-6">
        @if(session('success'))
            <div class="card-dark p-4 border-l-4 border-[#ADFF2F]">
                <p class="text-white font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="card-header">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                    <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <div class="title">Membership Plans</div>
                    <div class="subtitle">Manage gym membership packages and pricing</div>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('membership_plan.create') }}" class="btn-primary-custom inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Plan
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($plans as $plan)
                <div class="card-dark hover:border-[#ADFF2F] transition-all">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-4">{{ $plan->nama_plan }}</h3>

                        <div class="mb-4">
                            <span class="text-3xl font-bold text-[#ADFF2F]">Rp {{ number_format($plan->harga, 0, ',', '.') }}</span>
                            <p class="text-sm text-gray-400 mt-1">per {{ $plan->periode_bulan }} bulan</p>
                        </div>

                        <div class="mb-6">
                            <span class="px-3 py-1 rounded-lg text-xs font-medium bg-[#1f1f1f] border border-[#2a2a2a] text-gray-300">
                                {{ $plan->periode_bulan }} Bulan
                            </span>
                        </div>

                        @if($plan->plan_id)
                            <div class="flex items-center gap-3">
                                <a href="{{ route('membership_plan.show', $plan->plan_id) }}" class="btn-secondary flex-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span class="ml-2">View Details</span>
                                </a>

                                <a href="{{ route('membership_plan.edit', $plan->plan_id) }}"
                                   class="btn-primary-custom inline-flex items-center justify-center px-4 py-2">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('membership_plan.destroy', $plan->plan_id) }}" method="POST" onsubmit="return confirm('Yakin hapus plan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-red-600/90 hover:bg-red-600 text-white text-sm font-semibold rounded-xl transition-all duration-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto">
        {{-- Header --}}
        <div class="card-header mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                    <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <div>
                    <div class="title">Detail Membership Plan</div>
                    <div class="subtitle">View membership plan information</div>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('membership_plan.index') }}" class="px-4 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white rounded-lg font-medium transition-colors inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>

        {{-- Details Card --}}
        <div class="card-dark p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-gray-400 text-sm">Nama Plan</label>
                    <p class="text-white text-lg mt-1">{{ $plan->nama_plan }}</p>
                </div>
                <div>
                    <label class="text-gray-400 text-sm">Harga</label>
                    <p class="text-white text-lg mt-1">Rp {{ number_format($plan->harga, 0, ',', '.') }}</p>
                </div>
                <div>
                    <label class="text-gray-400 text-sm">Durasi</label>
                    <p class="text-white text-lg mt-1">{{ $plan->periode_bulan }} bulan</p>
                </div>
            </div>
            
            <div class="pt-4 border-t border-[#2a2a2a]">
                <label class="text-gray-400 text-sm">Deskripsi</label>
                <p class="text-white mt-2">{{ $plan->deskripsi ?? 'No description' }}</p>
            </div>

            <div class="pt-4 border-t border-[#2a2a2a] flex gap-3">
                <a href="{{ route('membership_plan.edit', $plan) }}" class="btn-primary-custom">
                    ✎ Edit
                </a>
                <form action="{{ route('membership_plan.destroy', $plan) }}" method="POST" onsubmit="return confirm('Delete this plan?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 bg-red-500/20 hover:bg-red-500/30 text-red-400 rounded-lg font-medium transition-colors">
                        🗑 Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

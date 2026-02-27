@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0a0a0a] p-4 md:p-8">
    <div class="w-full mx-auto">
        {{-- Header --}}
        <div class="card-header mb-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(173,255,47,0.08)">
                    <svg class="w-5 h-5 text-[#ADFF2F]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <div class="title">Detail Pembayaran</div>
                    <div class="subtitle">View billing information</div>
                </div>
            </div>
            <div class="ml-auto">
                <a href="{{ route('billing.index') }}" class="px-4 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white rounded-lg font-medium transition-colors inline-flex items-center gap-2">
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
                    <label class="text-gray-400 text-sm">Billing ID</label>
                    <p class="text-white text-lg mt-1">#{{ $billing->billing_id }}</p>
                </div>
                <div>
                    <label class="text-gray-400 text-sm">Member ID</label>
                    <p class="text-white text-lg mt-1">{{ $billing->member_id }}</p>
                </div>
                <div>
                    <label class="text-gray-400 text-sm">Plan ID</label>
                    <p class="text-white text-lg mt-1">{{ $billing->plan_id }}</p>
                </div>
                <div>
                    <label class="text-gray-400 text-sm">Jumlah</label>
                    <p class="text-white text-lg mt-1">Rp {{ number_format($billing->jumlah, 0, ',', '.') }}</p>
                </div>
                <div>
                    <label class="text-gray-400 text-sm">Tanggal Tagihan</label>
                    <p class="text-white text-lg mt-1">{{ $billing->tanggal_tagihan ? \Carbon\Carbon::parse($billing->tanggal_tagihan)->format('d/m/Y') : '-' }}</p>
                </div>
                <div>
                    <label class="text-gray-400 text-sm">Tanggal Jatuh Tempo</label>
                    <p class="text-white text-lg mt-1">{{ $billing->tanggal_jatuh_tempo ? \Carbon\Carbon::parse($billing->tanggal_jatuh_tempo)->format('d/m/Y') : '-' }}</p>
                </div>
            </div>

            <div class="pt-4 border-t border-[#2a2a2a]">
                <label class="text-gray-400 text-sm">Status Pembayaran</label>
                <p class="text-white text-lg mt-1">
                    <span class="px-3 py-1 rounded-lg text-sm {{ $billing->status_pembayaran == 'Paid' ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                        {{ $billing->status_pembayaran }}
                    </span>
                </p>
            </div>

            <div class="pt-4 border-t border-[#2a2a2a] flex gap-3">
                <a href="{{ route('billing.edit', $billing->billing_id) }}" class="btn-primary-custom">
                    ✎ Edit
                </a>
                <form action="{{ route('billing.destroy', $billing->billing_id) }}" method="POST" onsubmit="return confirm('Delete this billing?')">
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

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
                    <div class="title">Add New Billing</div>
                    <div class="subtitle">Create a new billing record</div>
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

        @if ($errors->any())
        <div class="mb-6 card-dark border-l-4 border-red-500 p-4">
            <ul class="list-disc list-inside text-red-400 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <div class="card-dark p-6">
            <form action="{{ route('billing.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                                <label for="member_id" class="block text-gray-400 mb-2">Member</label>
                                <select name="member_id" id="member_id" class="input-dark w-full" required>
                                    <option value="">-- Select Member --</option>
                                    @if(!empty($members) && (is_array($members) || $members instanceof \Illuminate\Support\Collection))
                                        @foreach($members as $member)
                                            <option value="{{ $member->member_id }}">{{ $member->user ? $member->user->nama : 'Member #' . $member->member_id }}</option>
                                        @endforeach
                                    @else
                                        <option value="">No members available</option>
                                    @endif
                                </select>
                    </div>
                    <div>
                        <label for="plan_id" class="block text-gray-400 mb-2">Plan</label>
                        <select name="plan_id" id="plan_id" class="input-dark w-full" required onchange="updateJumlah()">
                            <option value="">-- Select Plan --</option>
                            @if(!empty($plans) && (is_array($plans) || $plans instanceof \Illuminate\Support\Collection))
                                @foreach($plans as $plan)
                                    <option value="{{ $plan->plan_id }}" data-harga="{{ $plan->harga }}">{{ $plan->nama_plan }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-white mb-2">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="input-dark w-full" value="{{ old('jumlah') }}" required placeholder="Amount">
                    </div>
                    <div>
                        <label for="status_pembayaran" class="block text-sm font-medium text-white mb-2">Status Pembayaran</label>
                        <input type="text" name="status_pembayaran" id="status_pembayaran" class="input-dark w-full" value="{{ old('status_pembayaran') }}" required placeholder="e.g. Paid, Pending">
                    </div>
                    <div>
                        <label for="tanggal_tagihan" class="block text-sm font-medium text-white mb-2">Tanggal Tagihan</label>
                        <input type="date" name="tanggal_tagihan" id="tanggal_tagihan" class="input-dark w-full" value="{{ old('tanggal_tagihan') }}" required>
                    </div>
                    <div>
                        <label for="tanggal_jatuh_tempo" class="block text-sm font-medium text-white mb-2">Tanggal Jatuh Tempo</label>
                        <input type="date" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo" class="input-dark w-full" value="{{ old('tanggal_jatuh_tempo') }}" required>
                    </div>
                </div>

                <script>
                function updateJumlah() {
                    var select = document.getElementById('plan_id');
                    var harga = select.options[select.selectedIndex].getAttribute('data-harga');
                    document.getElementById('jumlah').value = harga ? harga : '';
                }
                </script>

                <div class="mt-8 flex items-center space-x-4">
                    <button type="submit" class="btn-primary-custom flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Create Billing</span>
                    </button>
                    <a href="{{ route('billing.index') }}" class="px-6 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium transition duration-200">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

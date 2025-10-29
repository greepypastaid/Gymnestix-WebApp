@extends('layouts.app')

@section('content')
<div class="py-12 bg-black min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="bg-neutral-800 p-6 shadow sm:rounded-lg mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(173,255,47,0.1); color:#ADFF2F;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Add New Billing</h1>
                        <p class="text-neutral-400">Create a new billing record</p>
                    </div>
                </div>
                <a href="{{ route('billing.index') }}" class="px-4 py-2 bg-neutral-600 text-white rounded-lg hover:bg-neutral-500 font-medium flex items-center space-x-2 transition duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back</span>
                </a>
            </div>
        </div>

        @if ($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-red-500/20 border border-red-500/30">
            <ul class="list-disc list-inside text-red-400 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <div class="bg-neutral-800 shadow sm:rounded-lg p-6">
            <form action="{{ route('billing.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="member_id" class="block text-sm font-medium text-white mb-2">Member</label>
                        <select name="member_id" id="member_id" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" required>
                            <option value="">-- Select Member --</option>
                            @forelse($members as $member)
                                <option value="{{ $member->member_id }}">{{ $member->user ? $member->user->nama : 'Member #' . $member->member_id }}</option>
                            @empty
                                <option value="">No members available</option>
                            @endforelse
                        </select>
                    </div>
                    <div>
                        <label for="plan_id" class="block text-sm font-medium text-white mb-2">Plan</label>
                        <select name="plan_id" id="plan_id" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" required onchange="updateJumlah()">
                            <option value="">-- Select Plan --</option>
                            @foreach($plans as $plan)
                                <option value="{{ $plan->plan_id }}" data-harga="{{ $plan->harga }}">{{ $plan->nama_plan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-white mb-2">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('jumlah') }}" required placeholder="Amount">
                    </div>
                    <div>
                        <label for="status_pembayaran" class="block text-sm font-medium text-white mb-2">Status Pembayaran</label>
                        <input type="text" name="status_pembayaran" id="status_pembayaran" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('status_pembayaran') }}" required placeholder="e.g. Paid, Pending">
                    </div>
                    <div>
                        <label for="tanggal_tagihan" class="block text-sm font-medium text-white mb-2">Tanggal Tagihan</label>
                        <input type="date" name="tanggal_tagihan" id="tanggal_tagihan" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('tanggal_tagihan') }}" required>
                    </div>
                    <div>
                        <label for="tanggal_jatuh_tempo" class="block text-sm font-medium text-white mb-2">Tanggal Jatuh Tempo</label>
                        <input type="date" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo" class="block w-full px-3 py-2 border border-neutral-600 rounded-lg shadow-sm bg-neutral-700 text-white focus:outline-none focus:ring-2 focus:ring-[#ADFF2F] focus:border-[#ADFF2F]" value="{{ old('tanggal_jatuh_tempo') }}" required>
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
                    <button type="submit" class="px-6 py-2 rounded-lg font-medium flex items-center space-x-2 text-black hover:bg-[#9FE529] transition-all duration-200" style="background-color:#ADFF2F;">
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

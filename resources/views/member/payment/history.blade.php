@extends('landing_page.layouts.app')

@section('title', 'Riwayat Pembayaran')

@section('content')
    <div class="max-w-5xl mx-auto px-4 py-10 text-white">

        <h1 class="text-3xl font-heading font-semibold my-8">Riwayat Pembayaran</h1>

        <div class="bg-neutral-900/70 border border-neutral-800 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden">
            <table class="min-w-full text-sm">
                <thead class="bg-neutral-800/60 text-gray-300">
                    <tr>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Paket</th>
                        <th class="px-4 py-3 text-left">Metode</th>
                        <th class="px-4 py-3 text-left">VA / Code</th>
                        <th class="px-4 py-3 text-left">Jumlah</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Expired</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr class="border-b border-neutral-800 hover:bg-neutral-800/40 transition">
                            <td class="px-4 py-3">{{ $payment->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-3">{{ $payment->membershipPlan->nama_plan ?? '-' }}</td>
                            <td class="px-4 py-3 capitalize">{{ str_replace('_', ' ', $payment->payment_method ?? '-') }}
                            </td>
                            <td class="px-4 py-3 font-mono text-xs">
                                {{ $payment->va_number ?? ($payment->payment_code ?? '-') }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>

                            <td class="px-4 py-3">
                                @php
                                    $statusColors = [
                                        'paid' => 'bg-emerald-600/20 text-emerald-400 border border-emerald-600/50',
                                        'pending' => 'bg-yellow-600/20 text-yellow-400 border border-yellow-600/50',
                                        'expired' => 'bg-red-600/20 text-red-400 border border-red-600/50',
                                        'cancelled' => 'bg-gray-600/20 text-gray-400 border border-gray-600/50',
                                    ];
                                @endphp

                                <span
                                    class="px-2 py-1 rounded text-xs font-medium {{ $statusColors[$payment->status] ?? 'bg-gray-600/20' }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                {{ $payment->expired_at ? \Carbon\Carbon::parse($payment->expired_at)->format('d M Y H:i') : '-' }}
                            </td>

                            <td class="px-4 py-3 text-center relative">
                                <div x-data="{ open: false }" class="inline-block text-left">
                                    <button @click="open = !open"
                                        class="px-3 py-1 bg-neutral-800 hover:bg-neutral-700 text-white text-sm rounded-lg">
                                        Aksi ▾
                                    </button>

                                    <div x-show="open" @click.away="open = false"
                                        class="absolute right-0 mt-2 w-40 bg-neutral-900 border border-neutral-700 rounded-lg shadow-lg z-10">

                                        <!-- Lihat Invoice -->
                                        <a href="{{ route('payment.view', $payment->id) }}"
                                            class="block px-4 py-2 text-sm text-white hover:bg-neutral-800">
                                            Lihat Invoice
                                        </a>

                                        <!-- Cetak PDF -->
                                        <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-neutral-800">
                                            Cetak PDF
                                        </a>

                                        <!-- Tombol Bayar -->
                                        @if ($payment->status === 'pending')
                                            <a href="{{ $payment->payment_url }}" target="_blank"
                                                class="block px-4 py-2 text-sm text-emerald-400 hover:bg-neutral-800">
                                                Bayar Sekarang
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-6 text-gray-400">
                                Belum ada riwayat pembayaran
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $payments->links() }}
        </div>
    </div>
@endsection

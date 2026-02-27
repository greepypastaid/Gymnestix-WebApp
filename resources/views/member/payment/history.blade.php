@extends('landing_page.layouts.app')

@section('title', 'Riwayat Pembayaran')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mt-12 text-white">

        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-poppins mb-4">Riwayat Pembayaran</h1>
        <p class="text-left text-gray-400 text-base sm:text-lg max-w-2xl mb-8">Monitoring Pembayaran mu dengan mudah disini!</p>

        <div class="bg-[#141414] border border-[#2a2a2a] backdrop-blur-sm rounded-xl shadow-lg">
            <!-- Mobile: cards -->
            <div class="md:hidden p-4 space-y-4">
                @forelse ($payments as $payment)
                    <div class="bg-[#1f1f1f] p-4 rounded-lg border border-[#2a2a2a]">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <div class="text-sm font-semibold text-white">{{ $payment->membershipPlan->nama_plan ?? '-' }}</div>
                                <div class="text-xs text-gray-400">{{ $payment->created_at->format('d M Y H:i') }}</div>
                            </div>
                            @php
                                $statusColors = [
                                    'paid' => 'bg-emerald-600/20 text-emerald-400 border border-emerald-600/50',
                                    'pending' => 'bg-yellow-600/20 text-yellow-400 border border-yellow-600/50',
                                    'expired' => 'bg-red-600/20 text-red-400 border border-red-600/50',
                                    'cancelled' => 'bg-gray-600/20 text-gray-400 border border-gray-600/50',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded text-xs font-medium {{ $statusColors[$payment->status] ?? 'bg-gray-600/20' }}">{{ ucfirst($payment->status) }}</span>
                        </div>
                        <div class="text-xs text-gray-400 space-y-1 mb-3">
                            <div>Metode: {{ str_replace('_', ' ', $payment->payment_method ?? '-') }}</div>
                            <div>Jumlah: Rp {{ number_format($payment->amount, 0, ',', '.') }}</div>
                            @if($payment->expired_at)
                                <div>Expired: {{ \Carbon\Carbon::parse($payment->expired_at)->format('d M Y H:i') }}</div>
                            @endif
                        </div>
                        <div class="flex flex-col space-y-2">
                            <a href="{{ route('payment.view', $payment->id) }}" class="w-full text-center px-4 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white text-sm rounded-lg transition-colors">Lihat Invoice</a>
                            <a href="{{ route('payment.invoice.pdf', $payment->id) }}" target="_blank" class="w-full text-center px-4 py-2 bg-[#1f1f1f] hover:bg-[#2a2a2a] text-white text-sm rounded-lg transition-colors">Cetak PDF</a>
                            @if ($payment->status === 'pending')
                                <a href="{{ $payment->payment_url }}" target="_blank" class="w-full text-center px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white text-sm rounded-lg transition-colors">Bayar Sekarang</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-400">Belum ada riwayat pembayaran</div>
                @endforelse
            </div>

            <!-- Desktop: table -->
            <table class="hidden md:table min-w-full text-sm">
                <thead class="bg-[#1f1f1f] text-gray-300">
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

                            <td class="px-4 py-3 text-center ">
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
                                        <a href="{{ route('payment.invoice.pdf', $payment->id) }}" target="_blank"
                                            class="block px-4 py-2 text-sm text-white hover:bg-neutral-800">
                                            Cetak PDF
                                        </a>

                                        <!-- Tombol Bayar -->
                                        @if ($payment->status === 'pending')
                                            <a href="{{ $payment->payment_url }}" target="_blank"
                                                class="block px-4 py-2 text-sm text-emerald-400 hover:bg-neutral-800">
                                                Bayar Sekarang
                                            </a>

                                            <form action="{{ route('payment.cancel', $payment->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-neutral-800">
                                                    Batalkan
                                                </button>
                                            </form>
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

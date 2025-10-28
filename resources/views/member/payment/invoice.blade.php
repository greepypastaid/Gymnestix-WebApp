@extends('landing_page.layouts.app')

@section('title', 'Invoice ' . ($invoiceNumber ?? 'Invoice'))

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-12 bg-white text-gray-900 mt-20 ">
        <div class="flex justify-between items-center mb-8">
            <div class="flex items-center gap-4">
                {{-- Logo emerald --}}
                <div class="w-16 h-16 flex items-center justify-center rounded-md bg-emerald-50">
                    <img src="{{ asset('images/GymnestixLogo.png') }}" alt="Gymnestix" class="w-12 h-12 object-contain">
                </div>
                <div>
                    <div class="text-xl font-semibold">Gymnestix</div>
                    <div class="text-sm text-gray-500">Invoice</div>
                </div>
            </div>

            <div class="text-right">
                <div class="text-sm text-gray-500">No. Invoice</div>
                <div class="text-lg font-semibold">{{ $invoiceNumber }}</div>
                <div class="text-sm text-gray-500 mt-2">Tanggal: {{ $payment->created_at->format('d M Y') }}</div>
            </div>
        </div>

        {{-- Bill To & Payment Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <div class="text-xs text-gray-500 mb-2">Tagihan Kepada</div>
                <div class="font-semibold">{{ $payment->user->nama ?? ($payment->user->name ?? '-') }}</div>
                <div class="text-sm text-gray-600">{{ $payment->user->email ?? '-' }}</div>
                @if (!empty($payment->user->nomor_telepon))
                    <div class="text-sm text-gray-600">{{ $payment->user->nomor_telepon }}</div>
                @endif
            </div>

            <div>
                <div class="text-xs text-gray-500 mb-2">Detail Pembayaran</div>
                <div class="text-sm"><span class="text-gray-500">Metode:</span>
                    <strong>{{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? '-')) }}</strong>
                </div>
                <div class="text-sm"><span class="text-gray-500">External ID:</span>
                    <strong>{{ $payment->external_id ?? '-' }}</strong>
                </div>
                <div class="text-sm"><span class="text-gray-500">Nomor VA:</span>
                    <strong>{{ $payment->va_number ?? '-' }}</strong>
                </div>
            </div>
        </div>

        {{-- Items table --}}
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-left">
                        <th class="py-3 px-4 text-sm text-gray-600 border-b">Deskripsi</th>
                        <th class="py-3 px-4 text-sm text-gray-600 border-b text-right">Kuantitas</th>
                        <th class="py-3 px-4 text-sm text-gray-600 border-b text-right">Harga</th>
                        <th class="py-3 px-4 text-sm text-gray-600 border-b text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Example: membershipPlan --}}
                    <tr class="align-top">
                        <td class="py-4 px-4 border-b">
                            <div class="font-semibold">{{ $payment->membershipPlan->nama_plan ?? 'Membership' }}</div>
                            <div class="text-xs text-gray-500">Durasi: {{ $payment->membershipPlan->periode_bulan ?? '-' }}
                                bulan</div>
                        </td>
                        <td class="py-4 px-4 border-b text-right">1</td>
                        <td class="py-4 px-4 border-b text-right">Rp {{ number_format($payment->amount, 0, ',', '.') }}
                        </td>
                        <td class="py-4 px-4 border-b text-right">Rp {{ number_format($payment->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="py-3 px-4 text-right text-sm text-gray-600">Subtotal</td>
                        <td class="py-3 px-4 text-right font-semibold">Rp
                            {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    </tr>
                    {{-- No tax (you selected no tax) --}}
                    <tr>
                        <td colspan="3" class="py-3 px-4 text-right text-sm text-gray-600">Total</td>
                        <td class="py-3 px-4 text-right text-lg font-bold">Rp
                            {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Actions --}}
        <div class="mt-8 flex flex-col md:flex-row gap-3 items-center justify-between">
            <div class="text-sm text-gray-500">
                Status:
                <span class="font-medium">{{ ucfirst($payment->status) }}</span>
                @if ($payment->paid_at)
                    • Dibayar: {{ \Carbon\Carbon::parse($payment->paid_at)->format('d M Y H:i') }}
                @endif
            </div>

            <div class="flex gap-3">
                <a href="{{ route('payment.invoice.pdf', $payment->id) }}" target="_blank"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-md hover:bg-emerald-700 transition">
                    Download PDF
                </a>

                @if ($payment->status === 'pending' && $payment->payment_url)
                    <a href="{{ $payment->payment_url }}" target="_blank"
                        class="inline-flex items-center gap-2 px-4 py-2 border border-emerald-600 text-emerald-600 rounded-md hover:bg-emerald-50 transition">
                        Bayar Sekarang
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection

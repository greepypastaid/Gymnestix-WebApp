<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $invoiceNumber }}</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            color: #111;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 64px;
            height: 64px;
        }

        .small {
            color: #6b7280;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .total {
            font-weight: 700;
            font-size: 16px;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 8px;
            background: #ecfdf5;
            color: #065f46;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div>
                <img src="{{ public_path('logo-emerald.png') }}" class="logo" alt="Gymnestix">
            </div>
            <div style="text-align:right">
                <div style="font-weight:700">{{ $invoiceNumber }}</div>
                <div class="small">Tanggal: {{ $payment->created_at->format('d M Y') }}</div>
            </div>
        </div>

        <div style="margin-bottom:12px;">
            <div style="font-weight:700;">Tagihan Kepada</div>
            <div>{{ $payment->user->nama ?? ($payment->user->name ?? '-') }}</div>
            <div class="small">{{ $payment->user->email ?? '-' }}</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th class="text-right">Jumlah</th>
                    <th class="text-right">Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $payment->membershipPlan->nama_plan ?? 'Membership' }} <div class="small">Durasi:
                            {{ $payment->membershipPlan->periode_bulan ?? '-' }} bulan</div>
                    </td>
                    <td class="text-right">1</td>
                    <td class="text-right">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-right small">Subtotal</td>
                    <td class="text-right">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="2" class="text-right total">Total</td>
                    <td class="text-right total">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <div style="margin-top:18px;">
            <div class="small">Metode: {{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? '-')) }}</div>
            <div class="small">External ID: {{ $payment->external_id ?? '-' }}</div>
            <div class="small">Nomor VA: {{ $payment->va_number ?? '-' }}</div>
        </div>

        <div style="margin-top:24px; font-size:12px; color:#6b7280;">
            Terima kasih telah memilih Gymnestix. Simpan invoice ini sebagai bukti pembayaran.
        </div>
    </div>
</body>

</html>

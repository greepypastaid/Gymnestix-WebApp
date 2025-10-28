<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MembershipPaymentController extends Controller
{
    public function checkout($plan_id)
    {
        $plan = MembershipPlan::findOrFail($plan_id);
        $user = Auth::user();


        $external_id = 'ORDER-' . strtoupper(uniqid());
        $apiKey = config('services.payment.api_key', 'UJ6JxQRgpNb74GjnOrriIUPQd96A6ovo'); // sebaiknya ambil dari .env

        try {
            $response = Http::withHeaders([
                'X-API-Key' => $apiKey,
                'Accept' => 'application/json',
            ])->withoutVerifying()->post(config('services.payment.base_url') . '/virtual-account/create', [
                'external_id' => $external_id,
                'amount' => $plan->harga,
                'customer_name' => $user->nama,
                'customer_email' => $user->email,
                'description' => "Membership Plan: {$plan->nama_plan}",
                'expired_duration' => 24, // jam
                'metadata' => [
                    'plan_id' => $plan->plan_id,
                    'user_id' => $user->user_id
                ],
            ]);

            if ($response->failed()) {
                dd($response->body());
                Log::error('Payment API Error', ['body' => $response->body()]);
                return back()->with('error', 'Gagal membuat virtual account, silakan coba lagi.');
            }

            $data = $response->json('data');

            // Validasi respons dari API
            if (!$data || !isset($data['va_number'])) {
                Log::error('Invalid payment API response', ['response' => $response->json()]);
                return back()->with('error', 'Respons pembayaran tidak valid.');
            }

            // Simpan pembayaran ke database
            // FIX BUAT SI ANJINGGG!!
            $expiredAt = isset($data['expired_at']) 
                ? \Carbon\Carbon::parse($data['expired_at'])->format('Y-m-d H:i:s')
                : now()->addDay()->format('Y-m-d H:i:s');

            $payment = Payment::create([
                'user_id' => $user->user_id,
                'membership_plan_id' => $plan->plan_id,
                'external_id' => $external_id,
                'va_number' => $data['va_number'],
                'amount' => $data['amount'] ?? $plan->harga,
                'status' => $data['status'] ?? 'PENDING',
                'payment_url' => $data['payment_url'] ?? null,
                'expired_at' => $expiredAt,
            ]);

            return view('landing_page.pages.membership.checkout', compact('plan', 'payment'));
        } catch (\Throwable $e) {
            Log::error('Payment Checkout Error', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat membuat pembayaran.');
        }
    }

    public function paymentHistory()
    {
        $payments = \App\Models\Payment::with('membershipPlan')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        foreach ($payments as $payment) {
            if ($payment->status === 'pending' && $payment->expired_at <= now()) {
                $payment->update(['status' => 'expired']);
            }
        }

        // setelah update, load ulang untuk memunculkan status baru
        $payments = \App\Models\Payment::with('membershipPlan')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('member.payment.history', compact('payments'));
    }


    public function checkStatus(Payment $payment)
    {
        return response()->json(['status' => $payment->status]);
    }

    public function success(Payment $payment)
    {
        if ($payment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this payment.');
        }

        if ($payment->status !== 'paid') {
            return redirect()->route('member.payment.history');
        }

        return view('landing_page.pages.membership.success', compact('payment'));
    }

    // Tampilkan invoice di browser (light mode)
    public function viewInvoice(Payment $payment)
    {
        // Pastikan hanya owner yang dapat melihat
        if ($payment->user_id !== Auth::id()) {
            abort(403);
        }

        // Optional: generate invoice number format GYM/INV/000123
        $invoiceNumber = $payment->invoice_number ?? 'GYM/INV/' . str_pad($payment->id, 6, '0', STR_PAD_LEFT);

        // Pass ke view (view juga digunakan untuk PDF)
        return view('member.payment.invoice', compact('payment', 'invoiceNumber'));
    }

    // Generate PDF (stream) dari view
    public function downloadInvoicePdf(Payment $payment)
    {
        // pastikan hanya owner yang dapat mengakses
        if ($payment->user_id !== Auth::id()) {
            abort(403);
        }

        // Tanpa slash
        $invoiceNumber = $payment->invoice_number ?? 'GYM-INV-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT);


        $data = ['payment' => $payment, 'invoiceNumber' => $invoiceNumber];

        try {
            $pdf = PDF::loadView('member.payment.invoice_pdf', $data);
            return $pdf->stream($invoiceNumber . '.pdf');
        } catch (\Throwable $e) {
            Log::error('PDF error: ' . $e->getMessage());
            dd($e->getMessage());
        }


        // jika mau paksa download, pakai:
        // return $pdf->download($invoiceNumber . '.pdf');
    }
}

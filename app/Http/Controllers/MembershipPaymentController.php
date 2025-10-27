<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use App\Models\Payment;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            $payment = Payment::create([
                'user_id' => $user->user_id,
                'membership_plan_id' => $plan->plan_id,
                'external_id' => $external_id,
                'va_number' => $data['va_number'],
                'amount' => $data['amount'] ?? $plan->harga,
                'status' => $data['status'] ?? 'PENDING',
                'payment_url' => $data['payment_url'] ?? null,
                'expired_at' => $data['expired_at'] ?? now()->addDay(),
            ]);

            return view('landing_page.pages.membership.checkout', compact('plan', 'payment'));
        } catch (\Throwable $e) {
            Log::error('Payment Checkout Error', ['error' => $e->getMessage()]);
            return back()->with('error', 'Terjadi kesalahan saat membuat pembayaran.');
        }
    }
}

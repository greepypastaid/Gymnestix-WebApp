<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Member;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handlePayment(Request $request)
    {
        try {
            Log::info('Webhook received', $request->all());

            // --- Verify webhook signature ---
            $signature = $request->header('X-Webhook-Signature');
            $webhookSecret = config('services.payment.webhook_secret');

            if (empty($signature) || empty($webhookSecret)) {
                Log::warning('Missing signature or secret');
                return response()->json(['error' => 'Missing signature or secret'], 400);
            }

            $payload = $request->getContent();
            $expectedSignature = hash_hmac('sha256', $payload, $webhookSecret);

            if (!hash_equals($expectedSignature, $signature)) {
                Log::warning('Invalid webhook signature', [
                    'expected' => $expectedSignature,
                    'received' => $signature,
                ]);
                return response()->json(['error' => 'Invalid signature'], 401);
            }

            // --- Process webhook ---
            $event = $request->input('event');
            $data = $request->input('data', []);
            // $customData = $request->input('meta', []);
            $externalId = $data['external_id'] ?? null;

            Log::info('data semua : ', $request->all());
            if (!$externalId) {
                Log::warning('Missing external_id', ['data' => $data]);
                return response()->json(['error' => 'Missing external_id'], 422);
            }

            $payment = Payment::where('external_id', $externalId)->first();

            if (!$payment) {
                Log::warning('Payment not found', ['external_id' => $externalId]);
                return response()->json(['error' => 'Payment not found'], 404);
            }

            match ($event) {
                'payment.success' => $this->handleSuccess($payment, $data),
                'payment.expired' => $payment->update(['status' => 'expired']),
                'payment.cancelled' => $payment->update(['status' => 'cancelled']),
                default => Log::warning('Unknown webhook event', ['event' => $event]),
            };

            return response()->json(['message' => 'Webhook processed successfully'], 200);
        } catch (\Throwable $e) {
            Log::error('Webhook error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    protected function handleSuccess($payment, $data)
    {
        $payment->update([
            'status' => 'paid',
            'payment_method' => $data['payment_method'],
            'paid_at' => now(),
        ]);

        // $membershipPlan = MembershipPlan::findOrFail($customData['plan_id']);

        // Update atau buat data member
        Member::updateOrCreate(
            ['user_id' => $payment->user_id],
            [
                'tanggal_registrasi' => now(),
                'status_keanggotaan' => 'Aktif',
                'membership_plan_id' => $payment->membership_plan_id,
                'expired_at' => now()->addMonths($payment->membershipPlan->periode_bulan),
            ]
        );


        $user = \App\Models\User::find($payment->user_id);
        if ($user) {
            $user->update(['role_id' => 3]);
        }

        Log::info('Payment success processed', [
            'payment_id' => $payment->id,
            'user_id' => $payment->user_id,
            'plan_id' => $payment->membership_plan_id,
            'role_updated' => $user ? $user->role_id : 'user not found',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function handlePayment(Request $request)
    {
        // Log payload mentah
        $payload = file_get_contents('php://input');
        Log::info('Webhook received raw', ['payload' => $payload]);

        // Verifikasi tanda tangan
        $signature = $request->header('X-Webhook-Signature');
        $secret = config('services.payment.webhook_secret');
        $expectedSignature = hash_hmac('sha256', $payload, $secret);

        if (!hash_equals($expectedSignature, $signature)) {
            Log::warning('Invalid webhook signature', [
                'expected' => $expectedSignature,
                'received' => $signature,
            ]);
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        //  Decode JSON
        $data = json_decode($payload, true);
        $event = $data['event'] ?? null;
        $content = $data['data'] ?? [];
        $externalId = $content['external_id'] ?? null;

        if (!$externalId) {
            return response()->json(['error' => 'Missing external_id'], 422);
        }

        $payment = Payment::where('external_id', $externalId)->first();

        if (!$payment) {
            Log::warning('Payment not found', ['external_id' => $externalId]);
            return response()->json(['error' => 'Payment not found'], 404);
        }

        //  Proses event
        match ($event) {
            'payment.success' => $this->handleSuccess($payment),
            'payment.expired' => $payment->update(['status' => 'expired']),
            'payment.cancelled' => $payment->update(['status' => 'cancelled']),
            default => Log::warning('Unknown webhook event', ['event' => $event]),
        };

        return response()->json(['message' => 'Webhook processed successfully'], 200);
    }

    protected function handleSuccess($payment)
    {
        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        Member::updateOrCreate(
            ['user_id' => $payment->user_id],
            [
                'tanggal_registrasi' => now(),
                'status_keanggotaan' => 'Aktif',
            ]
        );

        Log::info('Payment success processed', [
            'payment_id' => $payment->id,
            'user_id' => $payment->user_id,
            'plan_id' => $payment->membership_plan_id,
        ]);
    }
}

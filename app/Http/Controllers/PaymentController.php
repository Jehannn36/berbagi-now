<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\MidtransService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function createPayment(Request $request)
    {
        $user = auth()->user();

        $premiumType = $request->premium_type;
        $prices = [
            14 => 10000,
            30 => 15000,
            60 => 30000,
        ];

        $amount = $prices[$premiumType];

        $orderId = 'order_'.$user->id.'_'.time();

        $snapToken = $this->midtransService->createTransaction($orderId, $amount, $user->email, $user->name);

        return response()->json([
            'snap_token' => $snapToken,
        ]);
    }

    public function verifyPayment(Request $request)
    {
        $transaction_status = $request->input('transaction_status');
        $order_id = $request->input('order_id');
        $user_id = $request->input('user_id');
        $premium_type = (int) $request->input('premium_type');

        $user = User::find($user_id);

        if (! $user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        if ($transaction_status == 'settlement') {
            $user->expired_member = now()->addDays($premium_type);
            $user->save();

            return response()->json(['message' => 'Payment successful and member status updated.']);
        }

        return response()->json(['message' => 'Payment failed or not yet settled.'], 400);
    }
}

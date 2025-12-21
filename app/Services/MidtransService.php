<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = false;
    }

    public function createTransaction($order_id, $amount, $email, $name)
    {
        $transaction_details = [
            'order_id' => $order_id,
            'gross_amount' => $amount,
        ];

        $customer_details = [
            'first_name' => $name,
            'email' => $email,
        ];

        $transaction = [
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        ];

        $snapToken = Snap::getSnapToken($transaction);

        return $snapToken;
    }
}

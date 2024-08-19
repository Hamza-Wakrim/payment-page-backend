<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function processPayment($product, $paymentDetails)
    {
        try {
            //should create subscription


        } catch (\Exception $e) {
            Log::error('Payment failed: ' . $e->getMessage());
            throw new \Exception('Payment failed, please try again.');
        }
    }
}

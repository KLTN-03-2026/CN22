<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    public function create(array $data)
    {
        return Payment::create($data);
    }

    public function findByOrderId($orderId)
    {
        return Payment::where('order_id', $orderId)->first();
    }

    public function update($payment, array $data)
    {
        $payment->update($data);
        return $payment;
    }
}

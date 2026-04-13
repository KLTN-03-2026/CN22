<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    public function createOrderWithItems(array $orderData, array $items)
    {
        return DB::transaction(function () use ($orderData, $items) {

            // tạo order
            $order = Order::create($orderData);

            // tạo order items
            foreach ($items as $item) {
                $order->items()->create($item);
            }

            return $order->load('items');
        });
    }

    public function findById($id)
    {
        return Order::with(['items', 'payment'])->findOrFail($id);
    }

    public function markAsPaid($orderId)
    {
        return Order::where('id', $orderId)
            ->update(['status' => Order::STATUS_PAID]);
    }

    public function exists($orderId)
    {
        return Order::where('id', $orderId)->exists();
    }
}

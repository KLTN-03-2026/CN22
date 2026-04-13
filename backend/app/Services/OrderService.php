<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    protected $orderRepo;
    protected $paymentRepo;

    public function __construct(
        OrderRepository $orderRepo,
        PaymentRepository $paymentRepo
    ) {
        $this->orderRepo = $orderRepo;
        $this->paymentRepo = $paymentRepo;
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE ORDER
    |--------------------------------------------------------------------------
    */
    public function createOrder(array $data)
    {
        $userId = Auth::id();

        $course = Course::findOrFail($data['course_id']);

        $type = $data['type'];

        $items = [];
        $totalPrice = 0;

        /*
        |--------------------------------------------------------------------------
        | CASE 1: MUA FULL COURSE
        |--------------------------------------------------------------------------
        */
        if ($type === Order::FULL_COURSE) {

            $totalPrice = $course->price;

            $items[] = [
                'chapter_id' => null,
                'price' => $totalPrice
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | CASE 2: MUA THEO CHƯƠNG
        |--------------------------------------------------------------------------
        */
        elseif ($type === Order::CHAPTER) {

            if (empty($data['chapter_ids'])) {
                throw new \Exception('Chapter IDs required');
            }

            $chapters = Chapter::whereIn('id', $data['chapter_ids'])
                ->where('course_id', $course->id)
                ->get();

            if ($chapters->count() !== count($data['chapter_ids'])) {
                throw new \Exception('Invalid chapters');
            }

            foreach ($chapters as $chapter) {
                $items[] = [
                    'chapter_id' => $chapter->id,
                    'price' => $chapter->price
                ];

                $totalPrice += $chapter->price;
            }
        }

        else {
            throw new \Exception('Invalid order type');
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE ORDER
        |--------------------------------------------------------------------------
        */
        $order = $this->orderRepo->createOrderWithItems(
            [
                'user_id' => $userId,
                'course_id' => $course->id,
                'type' => $type,
                'total_price' => $totalPrice,
                'status' => Order::STATUS_PENDING
            ],
            $items
        );

        /*
        |--------------------------------------------------------------------------
        | CREATE PAYMENT (pending)
        |--------------------------------------------------------------------------
        */
        $this->paymentRepo->create([
            'order_id' => $order->id,
            'method' => 'sepay',
            'amount' => $totalPrice,
            'status' => Order::STATUS_PENDING
        ]);

        return $order->load('items');
    }
}

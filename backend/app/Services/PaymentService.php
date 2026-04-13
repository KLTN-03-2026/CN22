<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Payment;
use App\Models\UserChapter;
use Illuminate\Support\Facades\DB;

class PaymentService
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
    | TẠO QR THANH TOÁN
    |--------------------------------------------------------------------------
    */
    public function createSePay($orderId)
    {
        $order = $this->orderRepo->findById($orderId);

        if ($order->status !== Order::STATUS_PENDING) {
            throw new \Exception('Order is not payable');
        }

        // tạo payment nếu chưa có
        $payment = $this->paymentRepo->findByOrderId($orderId);

        if (!$payment) {
            $payment = $this->paymentRepo->create([
                'order_id' => $order->id,
                'method' => 'sepay',
                'amount' => $order->total_price,
                'status' => Order::STATUS_PENDING
            ]);
        }

        // nội dung chuyển khoản
        $content = "ORDER{$order->id}";

        // tạo QR (SePay)
        $qr = "https://qr.sepay.vn/img?bank=MBBankacc=" . env('SEPAY_BANK_ACCOUNT')
            . "&template=compact&amount={$order->total_price}&des={$content}";

        return [
            'qr_code' => $qr,
            'content' => $content,
            'amount' => $order->total_price
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | HANDLE WEBHOOK
    |--------------------------------------------------------------------------
    */
    public function handleWebhook(array $data)
    {
        return DB::transaction(function () use ($data) {

            // lưu raw để debug
            $content = $data['content'] ?? '';
            $amount = $data['amount'] ?? 0;
            $transactionId = $data['transaction_id'] ?? null;

            // parse ORDER{id}
            preg_match('/ORDER(\d+)/', $content, $match);
            $orderId = $match[1] ?? null;

            if (!$orderId) {
                throw new \Exception('Invalid content');
            }

            $order = $this->orderRepo->findById($orderId);

            $payment = $this->paymentRepo->findByOrderId($orderId);

            if (!$payment) {
                throw new \Exception('Payment not found');
            }

            // chống duplicate
            if ($payment->status === Payment::SUCCESS) {
                return true;
            }

            // check số tiền
            if ((float)$payment->amount !== (float)$amount) {
                throw new \Exception('Amount mismatch');
            }

            // update payment
            $this->paymentRepo->update($payment, [
                'status' => Payment::SUCCESS,
                'transaction_code' => $transactionId,
                'raw_data' => $data,
                'paid_at' => now()
            ]);

            // update order
            $this->orderRepo->markAsPaid($orderId);

            // unlock nội dung
            $this->unlockContent($order);

            return true;
        });
    }

    /*
    |--------------------------------------------------------------------------
    | UNLOCK CONTENT
    |--------------------------------------------------------------------------
    */
    private function unlockContent($order)
    {
        if ($order->type === Order::FULL_COURSE) {

            Enrollment::updateOrCreate(
                [
                    'user_id' => $order->user_id,
                    'course_id' => $order->course_id
                ],
                [
                    'access_type' => 'full',
                    'enrolled_at' => now()
                ]
            );
        } else {

            // tạo enrollment nếu chưa có
            Enrollment::firstOrCreate(
                [
                    'user_id' => $order->user_id,
                    'course_id' => $order->course_id
                ],
                [
                    'access_type' => 'partial',
                    'enrolled_at' => now()
                ]
            );

            foreach ($order->items as $item) {
                UserChapter::firstOrCreate([
                    'user_id' => $order->user_id,
                    'chapter_id' => $item->chapter_id
                ]);
            }
        }
    }
}

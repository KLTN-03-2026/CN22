<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE QR
    |--------------------------------------------------------------------------
    */
    public function create(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id'
        ]);

        $result = $this->paymentService->createSePay($request->order_id);

        return response()->json($result);
    }

    /*
    |--------------------------------------------------------------------------
    | WEBHOOK
    |--------------------------------------------------------------------------
    */
    public function webhook(Request $request)
    {
        $this->paymentService->handleWebhook($request->all());

        return response()->json([
            'message' => 'Webhook processed'
        ]);
    }
}

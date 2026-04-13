<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE ORDER
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|integer|in:1,2',
            'chapter_ids' => 'array'
        ]);

        $order = $this->orderService->createOrder($request->all());

        return response()->json([
            'message' => 'Order created',
            'data' => $order
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW ORDER
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $order = app(\App\Repositories\OrderRepository::class)
            ->findById($id);

        return response()->json($order);
    }
}

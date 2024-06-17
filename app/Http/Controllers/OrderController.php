<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends MainController
{
    public function index()
    {
        $orders = Order::with('orderDetails')->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $order = Order::create($request->all());
        
        foreach ($request->order_details as $detail) {
            $detail['order_id'] = $order->id;
            OrderDetail::create($detail);
        }

        return response()->json($order->load('orderDetails'), 201);
    }
}

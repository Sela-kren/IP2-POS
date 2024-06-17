<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cashier_id' => 'required|integer',
            'receipt_number' => 'required|string|max:255',
            'total_price' => 'required|integer',
            'discount' => 'nullable|integer',
        ]);

        // Create the order
        $order = Order::create([
            'cashier_id' => $request->cashier_id,
            'receipt_number' => $request->receipt_number,
            'total_price' => $request->total_price,
            'discount' => $request->discount,
        ]);

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order,
        ], 201);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'status' => 'pending',
            'shipping_address' => $request->shipping_address
        ]);

        return response()->json($order);
    }

    public function show(string $id)
    {
        return Order::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $order->update($request->all());

        return response()->json($order);
    }

    public function destroy(string $id)
    {
        Order::destroy($id);

        return response()->json([
            'message' => 'Order deleted'
        ]);
    }
}
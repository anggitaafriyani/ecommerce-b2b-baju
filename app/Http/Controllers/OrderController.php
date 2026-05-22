<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // GET /api/orders
    public function index()
    {
        $orders = Order::with('user')->get();

        return response()->json($orders);
    }

    // POST /api/orders
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'status' => $request->status ?? 'pending',
            'shipping_address' => $request->shipping_address
        ]);

        return response()->json([
            'message' => 'Pesanan berhasil dibuat',
            'data' => $order
        ]);
    }

    // GET /api/orders/{id}
    public function show(string $id)
    {
        $order = Order::with('user')->findOrFail($id);

        return response()->json($order);
    }

    // PUT /api/orders/{id}
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);

        $order->update($request->all());

        return response()->json([
            'message' => 'Pesanan berhasil diupdate',
            'data' => $order
        ]);
    }

    // DELETE /api/orders/{id}
    public function destroy(string $id)
    {
        Order::destroy($id);

        return response()->json([
            'message' => 'Pesanan berhasil dihapus'
        ]);
    }
}
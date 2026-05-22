<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return Cart::all();
    }

    public function store(Request $request)
    {
        $cart = Cart::create([
            'user_id' => $request->user_id
        ]);

        return response()->json($cart);
    }

    public function show(string $id)
    {
        return Cart::findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->update($request->all());

        return response()->json($cart);
    }

    public function destroy(string $id)
    {
        Cart::destroy($id);

        return response()->json([
            'message' => 'Cart deleted'
        ]);
    }
}
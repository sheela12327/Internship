<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return response()->json(['message' => 'Insufficient stock'], 422);
        }

        $cart = Cart::firstOrCreate(['user_id' => $request->user_id]);

        $item = CartItem::updateOrCreate(
            ['cart_id' => $cart->id, 'product_id' => $product->id],
            ['quantity' => DB::raw('quantity + '.$request->quantity)]
        );

        return response()->json(['message' => 'Added to cart']);
    }

    public function view($userId)
    {
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) return [];

        return CartItem::with('product')
            ->where('cart_id', $cart->id)
            ->get();
    }

    public function update(Request $request, CartItem $item)
    {
        $item->update(['quantity' => $request->quantity]);
        return response()->json(['message' => 'Cart updated']);
    }

    public function remove(CartItem $item)
    {
        $item->delete();
        return response()->json(['message' => 'Item removed']);
    }
}

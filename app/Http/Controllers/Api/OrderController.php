<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
   public function place(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'payment_method' => 'nullable'
        ]);

        DB::beginTransaction();

        try {
            $cart = Cart::where('user_id', $request->user_id)->firstOrFail();
            $items = CartItem::where('cart_id', $cart->id)->get();

            $total = 0;

            $order = Order::create([
                'user_id' => $request->user_id,
                'total_amount' => 0,
                'status' => 'pending',
                'payment_method' => $request->payment_method
            ]);

            foreach ($items as $item) {
                $product = Product::lockForUpdate()->findOrFail($item->product_id);

                if ($product->stock < $item->quantity) {
                    throw new \Exception('Stock not sufficient');
                }

                $total += $product->price * $item->quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $product->price
                ]);

                $product->decrement('stock', $item->quantity);
            }

            $order->update(['total_amount' => $total]);

            // clear cart
            CartItem::where('cart_id', $cart->id)->delete();

            DB::commit();

            return response()->json([
                'message' => 'Order placed successfully',
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        $order->update([
            'status' => 'completed'
        ]);

        return response()->json(['message' => 'Payment successful']);
    }

    public function paymentFail(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        // restore stock
        foreach ($order->items as $item) {
            Product::where('id', $item->product_id)
                ->increment('stock', $item->quantity);
        }

        $order->update([
            'status' => 'cancelled'
        ]);

        return response()->json(['message' => 'Payment failed, order cancelled']);
    }

}

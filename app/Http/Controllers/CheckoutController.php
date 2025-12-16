<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index() {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) $total += $item['price'] * $item['qty'];
        return view('checkout.index', compact('cart','total'));
    }

    public function placeOrder(Request $request) {
        $cart = session()->get('cart', []);
        if(!$cart) return redirect()->back()->with('error','Cart is empty');

        $total = 0;
        foreach($cart as $item) $total += $item['price'] * $item['qty'];

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending'
        ]);

        foreach($cart as $id=>$item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['qty'],
                'price' => $item['price']
            ]);

            // Update stock
            $product = Product::find($id);
            $product->stock -= $item['qty'];
            $product->save();
        }

        session()->forget('cart');

        // Redirect to payment
        if($request->payment_method == 'esewa') {
            return redirect()->route('payment.esewa')->with('order_id',$order->id);
        } elseif($request->payment_method == 'khalti') {
            return redirect()->route('payment.khalti')->with('order_id',$order->id);
        }

        return redirect()->route('order.confirmation',$order->id);
    }
}

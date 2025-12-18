<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Show checkout page
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('checkout.index', compact('cart'));
    }

    // Place the order
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);
        if(empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Save order
        $order = Order::create([
            'user_id' => Auth::id() ?? null,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart)),
            'status' => 'pending',
            'payment_method' => $request->payment_method
        ]);

        // Save order items and update stock
        foreach($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'qty' => $item['qty'],
                'price' => $item['price'],
            ]);

            $product = Product::find($id);
            if($product) {
                $product->stock -= $item['qty'];
                $product->save();
            }
        }

        // Clear cart
        session()->forget('cart');

        // Redirect to payment page or order confirmation
        if($request->payment_method == 'esewa') {
            return view('payment.esewa', compact('order'));
        } elseif($request->payment_method == 'khalti') {
            return view('payment.khalti', compact('order'));
        } else {
            return redirect()->route('order.confirmation', $order->id);
        }
    }
}

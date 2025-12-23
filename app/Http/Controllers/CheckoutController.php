<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Show checkout page
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->get();

        return view('frontend.order.index', compact('cartItems'));
    }

    // Place the order
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|string|in:cash,esewa,khalti',
        ]);

        $cartItems = CartItem::with('product')
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        $totalAmount = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'price' => $item->product->price,
                'qty' => $item->quantity,
            ]);

            $item->product->decrement('stock', $item->quantity);
        }

        CartItem::whereIn('id', $cartItems->pluck('id'))->delete();

        // Redirect based on payment method
        switch ($request->payment_method) {
            case 'esewa':
                return view('payment.esewa', compact('order'));
            case 'khalti':
                return view('payment.khalti', compact('order'));
            default:
                return redirect()->route('order.confirmation', $order->id)
                    ->with('success', 'Order placed successfully.');
        }
    }

    // Order confirmation page
    public function confirmation(Order $order)
    {
        $order->load('items.product');
        return view('frontend.order.index', compact('order'));
    }
}

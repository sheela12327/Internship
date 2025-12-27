<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    // Show checkout page
    public function index()
    {
        if (Auth::check()) {
            // Logged-in user: fetch from database
            $cartItems = CartItem::with('product')
                ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
                ->get();
        } else {
            // Guest: fetch from session
            $sessionCart = session()->get('cart', []);
            $cartItems = collect();
            foreach ($sessionCart as $productId => $item) {
                $product = Product::find($productId);
                if ($product) {
                    $cartItems->push((object)[
                        'product' => $product,
                        'quantity' => $item['qty'] ?? $item['quantity'] ?? 1
                    ]);
                }
            }
        }

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

        if (Auth::check()) {
            $cartItems = CartItem::with('product')
                ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
                ->get();
        } else {
            $sessionCart = session()->get('cart', []);
            $cartItems = collect();
            foreach ($sessionCart as $productId => $item) {
                $product = Product::find($productId);
                if ($product) {
                    $cartItems->push((object)[
                        'product' => $product,
                        'quantity' => $item['qty'] ?? $item['quantity'] ?? 1
                    ]);
                }
            }
        }

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Calculate total amount
        $totalAmount = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Create Order
        $order = Order::create([
            'user_id' => Auth::id() ?? null,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        // Create Order Items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);

            if (Auth::check()) {
                $item->product->decrement('stock', $item->quantity);
                $item->delete(); // remove from database cart
            }
        }

        // Clear session cart for guest
        if (!Auth::check()) {
            session()->forget('cart');
        }

        // Redirect based on payment method
        switch ($request->payment_method) {
            case 'esewa':
                return view('payment.esewa', compact('order'));
            case 'khalti':
                return view('payment.khalti', compact('order'));
            default: // cash on delivery
                return redirect()->route('order.confirmation', $order->id)
                    ->with('success', 'Order placed successfully.');
        }
    }

    // Order confirmation page
    public function confirmation(Order $order)
    {
        $order->load('items.product');
        return view('frontend.order.confirmation', compact('order'));
    }

    // eSewa payment success
    public function paymentSuccess(Request $request)
    {
        return redirect()->route('order.confirmation', session('order_id'))
            ->with('success', 'Payment completed successfully.');
    }

    // eSewa payment cancelled
    public function paymentCancel(Request $request)
    {
        return redirect()->route('checkout')
            ->with('error', 'Payment was cancelled.');
    }
}

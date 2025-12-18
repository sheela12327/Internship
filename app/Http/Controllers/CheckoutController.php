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
       $cart = session()->get('cart');

        if (!$cart || count($cart) == 0) {
            return back()->with('error', 'Your cart is empty');
        }

        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'status' => 'pending'
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'], // VERY IMPORTANT
                'price' => $item['price'],
                'qty' => $item['qty'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('order.confirmation', $order->id)
            ->with('success', 'Order placed successfully.');

        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|string|in:esewa,khalti,cod', // cod = cash on delivery
        ]);

        // Calculate total amount
        $totalAmount = array_sum(array_map(fn($item) => $item['price'] * $item['qty'], $cart));

        // Create order
        $order = Order::create([
            'user_id' => Auth::id() ?? null,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_amount' => $totalAmount,  // <--- must match DB column
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        // Create order items and update stock
        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['qty'],
                'price' => $item['price'],
            ]);

            $product = Product::find($productId);
            if ($product) {
                $product->stock -= $item['qty'];
                $product->save();
            }
        }

        // Clear cart
        session()->forget('cart');

        // Redirect to payment page or order confirmation
        switch ($request->payment_method) {
            case 'esewa':
                return view('payment.esewa', compact('order'));
            case 'khalti':
                return view('payment.khalti', compact('order'));
            default: // cod or other
                return redirect()->route('order.confirmation', $order->id)
                                ->with('success', 'Order placed successfully.');
        }
    }
}
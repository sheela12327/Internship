<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    // Show checkout page
    public function index()
    {
        $cartItems = $this->getCartItems();
        return view('frontend.order.index', compact('cartItems'));
    }

    // Place the order
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:10', // Enforce 10 digit limit
            'address' => 'required|string|max:500',
            'payment_method' => 'required|string|in:cash,esewa,khalti',
        ]);

        // Get cart items
        $cartItems = $this->getCartItems();
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Calculate total
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

        // Create Order Items & reduce stock
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);

            // Reduce stock
            if($item->product) {
                $item->product->decrement('stock', $item->quantity);
            }
        }

        // Clear session cart for ALL users
        session()->forget('cart');

        // Store order ID in session for invoice download
        session(['last_order_id' => $order->id]);

        // Redirect to payment page
        if ($request->payment_method == 'esewa' || $request->payment_method == 'khalti') {
             return redirect()->route('checkout.payment', $order->id);
        }

        // Cash on delivery
        return redirect()->route('order.confirmation', $order->id)
            ->with('success', 'Order placed successfully.');
    }

    // Show Payment Page (PRG Pattern Fix)
    public function paymentPage(Order $order) 
    {
        if ($order->payment_method == 'esewa') {
            return view('payment.esewa', compact('order'));
        } elseif ($order->payment_method == 'khalti') {
            return view('payment.khalti', compact('order'));
        }
        
        return redirect()->route('index');
    }

    // Order confirmation page with "Download Invoice" button
    public function confirmation(Order $order)
    {
        $order->load('items.product');
        return view('order.confirmation', compact('order'));
    }

    // Generate PDF invoice
    public function downloadInvoice(Order $order)
    {
        $order->load('items.product');

        $data = [
            'name' => $order->name,
            'email' => $order->email,
            'phone' => $order->phone,
            'address' => $order->address,
            'notes' => $order->notes ?? '',
            'cart' => $order->items->map(fn($item) => [
                'name' => $item->product->name,
                'price' => $item->price,
                'quantity' => $item->quantity,
            ]),
        ];

        $pdf = Pdf::loadView('invoice', $data);
        return $pdf->download("Invoice_Order_{$order->id}.pdf");
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

    // Helper to get cart items from Session
    private function getCartItems()
    {
        $sessionCart = session()->get('cart', []);
        $cartItems = collect();
        foreach ($sessionCart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                // Return consistent object structure
                $cartItems->push((object)[
                    'product' => $product,
                    'quantity' => $item['qty'] ?? $item['quantity'] ?? 1
                ]);
            }
        }
        return $cartItems;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function esewaSuccess($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->status = 'completed';
        $order->save();

        return redirect()->route('order.confirmation', $order->id)
                         ->with('success', 'Payment successful via eSewa!');
    }

    public function esewaCancel($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->status = 'pending';
        $order->save();

        return redirect()->route('checkout.index')->with('error', 'Payment cancelled.');
    }

    public function khaltiSuccess($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->status = 'completed';
        $order->save();

        return redirect()->route('order.confirmation', $order->id)
                         ->with('success', 'Payment successful via Khalti!');
    }
}

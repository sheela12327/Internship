<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function initiateKhalti(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric', // Amount in paisa
        ]);

        $order = Order::findOrFail($request->order_id);

        // Khalti ePayment Initiate API v2
        $url = config('services.khalti.base_url') . 'epayment/initiate/';
        $payload = [
            'return_url' => route('payment.khalti.success', $order->id),
            'website_url' => config('app.url'),
            'amount' => $request->amount, // Amount in paisa
            'purchase_order_id' => $order->id,
            'purchase_order_name' => "Order #{$order->id}",
            'customer_info' => [
                'name' => $order->name,
                'email' => $order->email,
                'phone' => $order->phone,
            ]
        ];

        try {
            $response = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => 'Key ' . config('services.khalti.secret_key'),
                'Content-Type' => 'application/json',
            ])->post($url, $payload);

            $result = $response->json();

            if (isset($result['payment_url'])) {
                return redirect($result['payment_url']);
            } else {
                return back()->with('error', 'Khalti Payment Initiation Failed: ' . ($result['detail'] ?? 'Unknown Error'));
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

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

        return redirect()->route('checkout')->with('error', 'Payment cancelled.');
    }

    public function khaltiSuccess($orderId)
    {
        // TODO: Verify payment via 'epayment/lookup/' API if strictly required by Khalti docs, 
        // but for now we assume success if redirect happens here with 'pid'.
        
        $order = Order::findOrFail($orderId);
        $order->status = 'completed';
        $order->save();

        return redirect()->route('order.confirmation', $order->id)
                         ->with('success', 'Payment successful via Khalti!');
    }
}

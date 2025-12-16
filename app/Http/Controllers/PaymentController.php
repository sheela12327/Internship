<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
     public function esewaPayment(Request $request) {
        $order = Order::find(session('order_id'));
        $data = [
            'amt' => $order->total_amount,
            'pdc' => 0,
            'psc' => 0,
            'txAmt' => 0,
            'tAmt' => $order->total_amount,
            'pid' => $order->id,
            'su' => route('order.confirmation',$order->id),
            'fu' => route('cart')
        ];
        $query = http_build_query($data);
        return redirect('https://esewa.com.np/epay/main?'.$query);
    }

    public function khaltiPayment(Request $request) {
        $order = Order::find(session('order_id'));
        return view('payment.khalti', compact('order'));
    }
}

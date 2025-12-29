<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    // My Orders page
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('frontend.order.my_orders', compact('orders'));
    }

    // Order details + tracking
    public function show($id)
    {
        $order = Order::with('items.product')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('frontend.order.order_details', compact('order'));
    }

    // Invoice PDF
    public function invoice($id)
    {
        $order = Order::with('items.product', 'user')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $pdf = Pdf::loadView('frontend.order.invoice', compact('order'));

        return $pdf->download('invoice-order-'.$order->id.'.pdf');
    }
}

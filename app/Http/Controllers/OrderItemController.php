<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display all items of a specific order (Admin / Order details)
     */
    public function index($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);

        return view('admin.orders.items', compact('order'));
    }

    /**
     * Store order items (USED INTERNALLY – usually from OrderController)
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'price'      => 'required|numeric',
            'qty'        => 'required|integer|min:1',
        ]);

        OrderItem::create([
            'order_id'   => $request->order_id,
            'product_id' => $request->product_id,
            'price'      => $request->price,
            'qty'        => $request->qty,
        ]);

        return back()->with('success', 'Order item added successfully.');
    }

    /**
     * Remove an order item (Admin)
     */
    public function destroy($id)
    {
        $item = OrderItem::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Order item removed successfully.');
    }
}

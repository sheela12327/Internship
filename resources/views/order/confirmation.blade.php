@extends('template.template')

@section('pagecontent')

<style>
.order-summary, .billing-details {
    background: #fff;
    padding: 25px;
    border-radius: 5px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.order-col {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.order-total {
    font-size: 22px;
    color: #D10024;
}
</style>

<div class="section">
    <div class="container">
        <h2>Order Confirmation</h2>

        <div class="row">

            <!-- ORDER SUMMARY -->
            <div class="col-md-6">
                <div class="order-summary">
                    <h3 class="title">Your Order</h3>

                    @php $subtotal = 0; @endphp

                    @if(isset($order) && $order->items->count())
                        @foreach($order->items as $item)
                            @php
                                $itemTotal = $item->price * $item->quantity;
                                $subtotal += $itemTotal;
                            @endphp
                            <div class="order-col">
                                <div>{{ $item->quantity }}x {{ $item->product->name }}</div>
                                <div>${{ number_format($itemTotal, 2) }}</div>
                            </div>
                        @endforeach
                    @else
                        <p>No items found in this order.</p>
                    @endif

                    <div class="order-col">
                        <div><strong>Subtotal</strong></div>
                        <div><strong>${{ number_format($subtotal, 2) }}</strong></div>
                    </div>

                    <div class="order-col">
                        <div>Shipping</div>
                        <div><strong>FREE</strong></div>
                    </div>

                    <div class="order-col">
                        <div><strong>Total</strong></div>
                        <div><strong class="order-total">${{ number_format($subtotal, 2) }}</strong></div>
                    </div>
                </div>
            </div>

            <!-- BILLING DETAILS -->
            <div class="col-md-6">
                <div class="billing-details">
                    <h3 class="title">Billing Details</h3>

                    <p><strong>Name:</strong> {{ $order->name }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p><strong>Phone:</strong> {{ $order->phone }}</p>
                    <p><strong>Address:</strong> {{ $order->address }}</p>
                    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                </div>
            </div>

        </div>

        <div class="mt-4">
            <a href="{{ route('home') }}" class="primary-btn">Back to Home</a>
        </div>

    </div>
</div>

@endsection

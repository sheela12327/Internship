@extends('template.template')

@section('pagecontent')

<style>
.section {
    padding: 50px 0;
    font-family: 'Arial', sans-serif;
}

.order-summary, .billing-details {
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.order-col {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    border-bottom: 1px dashed #ddd;
    padding-bottom: 5px;
}

.order-col:last-child {
    border-bottom: none;
}

.order-total {
    font-size: 22px;
    color: #D10024;
}

.title {
    font-size: 20px;
    margin-bottom: 15px;
    font-weight: 600;
}

.billing-details p {
    margin-bottom: 8px;
}

.primary-btn, .invoice-btn {
    display: inline-block;
    padding: 10px 20px;
    background: #D10024;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 500;
    transition: background 0.3s;
}

.primary-btn:hover, .invoice-btn:hover {
    background: #a2001c;
}

.invoice-header {
    text-align: center;
    margin-bottom: 30px;
}

.invoice-header img {
    max-width: 120px;
    margin-bottom: 10px;
}

.invoice-header h1 {
    margin: 0;
    font-size: 26px;
    font-weight: 700;
}

.order-meta {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.order-meta div {
    font-weight: 500;
}
</style>

<div class="section">
    <div class="container">

        <!-- Logo and Title -->
        <div class="invoice-header">
            <img src="{{ asset('images/logo.png') }}" alt="Company Logo">
            <h1>Order Confirmation</h1>
        </div>

        <!-- Order Meta Info -->
        <div class="order-meta">
            <div><strong>Order ID:</strong> #{{ $order->id }}</div>
            <div><strong>Date:</strong> {{ $order->created_at->format('d M, Y H:i A') }}</div>
        </div>

        <div class="row">

            <!-- ORDER SUMMARY -->
            <div class="col-md-6">
                <div class="order-summary">
                    <h3 class="title">Order Summary</h3>

                    @php $subtotal = 0; @endphp

                    @if(isset($order) && $order->items->count())
                        @foreach($order->items as $item)
                            @php
                                $itemTotal = $item->price * $item->quantity;
                                $subtotal += $itemTotal;
                            @endphp
                            <div class="order-col">
                                <div>{{ $item->quantity }} x {{ $item->product->name }}</div>
                                <div>Rs. {{ number_format($itemTotal, 2) }}</div>
                            </div>
                        @endforeach
                    @else
                        <p>No items found in this order.</p>
                    @endif

                    <div class="order-col" style="border-top: 2px solid #ddd; padding-top: 10px;">
                        <div><strong>Subtotal</strong></div>
                        <div><strong>Rs. {{ number_format($subtotal, 2) }}</strong></div>
                    </div>

                    <div class="order-col">
                        <div>Shipping</div>
                        <div><strong>FREE</strong></div>
                    </div>

                    <div class="order-col">
                        <div><strong>Total</strong></div>
                        <div><strong class="order-total">Rs. {{ number_format($subtotal, 2) }}</strong></div>
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
                    <p><strong>Status:</strong>  <span class="badge 
                                {{ $order->status == 'completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ ucfirst($order->status) }}
                            </span></p>
                </div>
            </div>

        </div>

        <!-- Buttons -->
        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('home') }}" class="primary-btn">Back to Home</a>
            <a href="{{ route('order.invoice', $order->id) }}" class="invoice-btn">Download Invoice</a>
        </div>

    </div>
</div>

@endsection

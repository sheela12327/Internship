@extends('template.template')

@section('pagecontent')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <h2 class="mb-4 text-center fw-bold">Order Confirmation</h2>

            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Order Info -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <strong>Order #{{ $order->id }}</strong>
                </div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $order->name }}</p>
                        <p><strong>Email:</strong> {{ $order->email }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p><strong>Address:</strong> {{ $order->address }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                        <p>
                            <strong>Status:</strong>
                            <span class="badge 
                                {{ $order->status == 'completed' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3 fw-semibold">Order Items</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Price (Rs.)</th>
                                    <th>Quantity</th>
                                    <th>Subtotal (Rs.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp

                                @foreach($order->items as $item)
                                    @php
                                        $subtotal = $item->price * $item->quantity;
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ number_format($item->price, 2) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                @endforeach

                                <tr class="fw-bold">
                                    <td colspan="3" class="text-end">Total</td>
                                    <td>Rs. {{ number_format($total, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

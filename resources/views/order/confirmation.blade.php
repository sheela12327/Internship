@extends('template.template')

@section('pagecontent')
<div class="container mt-5">
    <h2>Order Confirmation</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <strong>Order #{{ $order->id }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            <p>
                <strong>Status:</strong> 
                @if($order->status == 'completed')
                    <span class="badge bg-success">Completed</span>
                @elseif($order->status == 'pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                @else
                    <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                @endif
            </p>
        </div>
    </div>

    <h4>Order Items</h4>
    <table class="table table-bordered">
        <thead>
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
                @php $subtotal = $item->price * $item->qty; $total += $subtotal; @endphp
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ number_format($subtotal, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-end"><strong>Total</strong></td>
                <td><strong>Rs. {{ number_format($total, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
</div>
@endsection

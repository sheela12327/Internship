@extends('template.template')

@section('pagecontent')
<div class="container mt-5">
    <h2>My Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info mt-3">
            You have no orders yet.
        </div>
    @else
        <table class="table table-bordered text-center mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>Rs. {{ $order->total_amount }}</td>
                    <td>{{ strtoupper($order->status) }}</td>
                    <td>
                        <a href="{{ route('customer.orders.show', $order->id) }}"
                           class="btn btn-sm btn-primary">
                            View
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

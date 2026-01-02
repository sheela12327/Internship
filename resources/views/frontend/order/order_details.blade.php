@extends('template.template')

@section('pagecontent')
<div class="container mt-5">
    <h2>Order Details</h2>

    <p><b>Order ID:</b> #{{ $order->id }}</p>
    <p><b>Status:</b> {{ $order->status }}</p>
    <p><b>Total:</b> Rs. {{ $order->total_amount }}</p>

@php
$steps = ['pending','processing','completed'];
$current = array_search($order->status, $steps);
@endphp

<div class="order-tracker my-4">
@foreach($steps as $i => $step)
    <div class="step {{ $i <= $current ? 'active' : '' }}">
        <div class="circle">{{ $i + 1 }}</div>
        <div class="step-title text-capitalize">{{ $step }}</div>
    </div>
@endforeach
</div>

<h4>Items</h4>
<table class="table table-bordered">
<thead>
<tr>
    <th>Product</th>
    <th>Qty</th>
    <th>Price</th>
</tr>
</thead>
<tbody>
@foreach($order->items as $item)
<tr>
    <td>{{ $item->product->name }}</td>
    <td>{{ $item->quantity }}</td>
    <td>Rs. {{ $item->price }}</td>
</tr>
@endforeach
</tbody>
</table>

<a href="{{ route('customer.orders.invoice', $order->id) }}"
   class="btn btn-success mt-3">
    Download Invoice (PDF)
</a>
</div>
@endsection

@push('styles')
<style>
.order-tracker { display:flex; justify-content:space-between; }
.step { width:100%; text-align:center; }
.circle {
    width:35px; height:35px; border-radius:50%;
    background:#ccc; color:white; line-height:35px;
    margin:auto;
}
.active .circle { background:#28a745; }
</style>
@endpush

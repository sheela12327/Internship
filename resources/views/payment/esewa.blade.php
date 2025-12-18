@extends('template.template')

@section('pagecontent')
<div class="container mt-5">
    <h2>eSewa Payment</h2>
    <p>Order ID: #{{ $order->id }}</p>
    <p>Total Amount: Rs. {{ number_format($order->total_amount, 2) }}</p>

    <form action="https://esewa.com.np/epay/main" method="POST" id="esewa_form">
        <input value="{{ $order->total_amount }}" name="tAmt" type="hidden">
        <input value="{{ $order->total_amount }}" name="amt" type="hidden">
        <input value="0" name="txAmt" type="hidden">
        <input value="0" name="psc" type="hidden">
        <input value="0" name="pdc" type="hidden">
        <input value="{{ $order->id }}" name="pid" type="hidden">
        <input value="{{ route('payment.esewa.success', $order->id) }}" type="hidden" name="su">
        <input value="{{ route('payment.esewa.cancel', $order->id) }}" type="hidden" name="fu">

        <button type="submit" class="btn btn-success">Pay with eSewa</button>
    </form>
</div>
@endsection

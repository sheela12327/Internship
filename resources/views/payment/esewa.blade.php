@extends('template.template')

@section('pagecontent')
<div class="section">
    <div class="container">
        <h2>Redirecting to eSewa...</h2>
        <p>Please wait while we redirect you to the payment gateway.</p>

        <form id="esewaForm" action="https://esewa.com.np/epay/main" method="POST">
            <input value="{{ $order->total_amount }}" name="tAmt" type="hidden">
            <input value="{{ $order->total_amount }}" name="amt" type="hidden">
            <input value="0" name="txAmt" type="hidden">
            <input value="0" name="psc" type="hidden">
            <input value="0" name="pdc" type="hidden">
            <input value="{{ $order->id }}" name="pid" type="hidden">
            <!-- <input value="{{ route('checkout.success') }}" name="su" type="hidden"> -->
            <!-- <input value="{{ route('checkout.cancel') }}" name="fu" type="hidden"> -->
        </form>
    </div>
</div>

<script>
    document.getElementById('esewaForm').submit();
</script>
@endsection

@extends('template.template')

@section('pagecontent')
<div class="section">
    <div class="container">
        <h2>Redirecting to Khalti...</h2>
        <p>Please wait while we redirect you to the payment gateway.</p>

        <form id="khaltiForm" action="{{ route('khalti.payment') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <input type="hidden" name="amount" value="{{ $order->total_amount * 100 }}"> <!-- amount in paisa -->
        </form>
    </div>
</div>

<script>
    document.getElementById('khaltiForm').submit();
</script>
@endsection

<form action="https://uat.esewa.com.np/epay/main" method="POST" id="esewa-form">
    <input value="{{ $order->total }}" name="tAmt" type="hidden">
    <input value="{{ $order->total }}" name="amt" type="hidden">
    <input value="0" name="txAmt" type="hidden">
    <input value="0" name="psc" type="hidden">
    <input value="0" name="pdc" type="hidden">
    <input value="{{ $order->id }}" name="pid" type="hidden">
    <input value="{{ route('order.confirmation', $order->id) }}" type="hidden" name="su">
    <input value="{{ route('checkout') }}" type="hidden" name="fu">
    <button type="submit">Pay with eSewa</button>
</form>

<script>
    document.getElementById('esewa-form').submit();
</script>

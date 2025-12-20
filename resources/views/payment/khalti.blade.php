<!-- @extends('template.template')

@section('pagecontent')
<div class="container mt-5">
    <h2>Khalti Payment</h2>
    <p>Order ID: #{{ $order->id }}</p>
    <p>Total Amount: Rs. {{ number_format($order->total_amount, 2) }}</p>

    <button id="khalti_btn" class="btn btn-primary">Pay with Khalti</button>
</div>

<script src="https://khalti.com/static/khalti-checkout.js"></script>
<script>
    var config = {
        "publicKey": "test_public_key_xxxxxxxxxxxxx", // Replace with your Khalti test public key
        "productIdentity": "{{ $order->id }}",
        "productName": "Order #{{ $order->id }}",
        "productUrl": "{{ route('home') }}",
        "eventHandler": {
            onSuccess (payload) {
                // Send payload to your backend for verification
                window.location.href = "{{ route('payment.khalti.success', $order->id) }}";
            },
            onError (error) {
                alert('Payment failed. Please try again.');
            },
            onClose () {
                alert('Payment popup closed.');
            }
        },
        "paymentPreference": ["KHALTI", "EBANKING","MOBILEBANKING","CONNECTIPS","SCT"]
    };
    var checkout = new KhaltiCheckout(config);
    document.getElementById("khalti_btn").onclick = function () {
        checkout.show({amount: {{ intval($order->total_amount * 100) }} }); // Amount in paisa
    }
</script>
@endsection -->

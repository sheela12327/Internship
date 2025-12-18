@extends('template.template')

@section('pagecontent')
<div class="container">
    <h2>Checkout</h2>

    <form action="{{ route('checkout.placeOrder') }}" method="POST">
        @csrf

        <h4>User Details</h4>
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
        </div>
        <div class="form-group">
            <textarea name="address" class="form-control" placeholder="Address" required></textarea>
        </div>

        <h4>Order Summary</h4>
        <ul>
            @foreach($cart as $item)
                <li>{{ $item['name'] }} x {{ $item['qty'] }} - Rs. {{ $item['price'] * $item['qty'] }}</li>
            @endforeach
        </ul>
        <h5>Total: Rs. {{ array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart)) }}</h5>

        <h4>Payment Method</h4>
        <div class="form-group">
            <select name="payment_method" class="form-control" required>
                <option value="esewa">eSewa</option>
                <option value="khalti">Khalti</option>
                <option value="cod">Cash on Delivery</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection

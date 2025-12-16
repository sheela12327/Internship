@extends('template.template')

@section('pagecontent')
<h2>Checkout</h2>
<form method="POST" action="{{ route('checkout.placeOrder') }}">
    @csrf
    <table class="table">
        <thead>
            <tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th></tr>
        </thead>
        <tbody>
            @foreach($cart as $id=>$item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>${{ $item['price'] }}</td>
                <td>{{ $item['qty'] }}</td>
                <td>${{ $item['price'] * $item['qty'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h4>Total: ${{ $total }}</h4>
    <label>Payment Method:</label>
    <select name="payment_method" required>
        <option value="esewa">eSewa</option>
        <option value="khalti">Khalti</option>
    </select>
    <button type="submit" class="btn btn-success">Place Order</button>
</form>
@endsection

@extends('template.template')

@section('pagecontent')
<div class="container mt-5">
    <h3>Your Cart</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th width="120">Qty</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="cart-items"></tbody>
    </table>

    <h4 class="text-right">Grand Total: Rs. <span id="grand-total">0</span></h4>

    <a href="{{ route('checkout') }}" class="btn btn-success float-right">
        Proceed to Checkout
    </a>
</div>
@endsection

@section('scripts')
<script>
let cart = JSON.parse(localStorage.getItem('cart')) || [];
let tbody = document.getElementById('cart-items');
let total = 0;

cart.forEach((item, index) => {
    let rowTotal = item.price * item.qty;
    total += rowTotal;

    tbody.innerHTML += `
        <tr>
            <td>${item.name}</td>
            <td>${item.price}</td>
            <td>
                <input type="number" value="${item.qty}"
                    onchange="updateQty(${index}, this.value)">
            </td>
            <td>${rowTotal}</td>
            <td>
                <button onclick="removeItem(${index})">X</button>
            </td>
        </tr>
    `;
});
document.getElementById('grand-total').innerText = total;
</script>
@endsection

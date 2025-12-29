@extends('template.template')

@section('pagecontent')
<div class="container">
    <h2>Shopping Cart</h2>

    @if(count($cart) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                    <tr data-id="{{ $id }}">
                        <td>{{ $item['name'] }}</td>
                        <td>Rs. {{ $item['price'] }}</td>
                        <td>
                            <input type="number" class="quantity" value="{{ $item['quantity'] }}" min="1" style="width:60px">
                        </td>
                        <td class="row-total">Rs. {{ $item['price'] * $item['quantity'] }}</td>
                        <td>
                            <button class="btn btn-danger remove-item">Remove</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: Rs. <span id="cart-total">{{ array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)) }}</span></h4>
        <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>

    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){

    // Update quantity
    $('.qty').on('change', function(){
        const row = $(this).closest('tr');
        const product_id = row.data('id');
        const quantity = $(this).val();

        $.ajax({
            url: "{{ route('cart.updateQuantity') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id,
                quantity: quantity
            },
            success: function(response){
                if(response.success){
                    const price = parseFloat(row.find('td:nth-child(2)').text().replace('Rs. ', ''));
                    row.find('.row-total').text('Rs. ' + (price * quantity));
                    updateCartTotal();
                }
            }
        });
    });

    // Remove item
    $('.remove-item').on('click', function(){
        const row = $(this).closest('tr');
        const product_id = row.data('id');

        $.ajax({
            url: "{{ route('cart.remove') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: product_id
            },
            success: function(response){
                if(response.success){
                    row.remove();
                    updateCartTotal();
                }
            }
        });
    });

    function updateCartTotal(){
        let total = 0;
        $('tbody tr').each(function(){
            const rowTotal = parseFloat($(this).find('.row-total').text().replace('Rs. ', ''));
            total += rowTotal;
        });
        $('#cart-total').text(total);
    }

});
</script>
@endsection

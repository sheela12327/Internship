@extends('template.template')

@section('pagecontent')

<style>
.order-summary, .billing-details, .payment-method {
    background: #fff;
    padding: 25px;
    border-radius: 5px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.order-col {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.order-total {
    font-size: 22px;
    color: #D10024;
}

.order-submit {
    width: 100%;
    margin-top: 20px;
    font-size: 16px;
}
</style>

<div class="section">
    <div class="container">
        <div class="row">

            <!-- ORDER SUMMARY -->
            <div class="col-md-5">
                <div class="order-summary">
                    <h3 class="title">Your Order</h3>

                    @php $subtotal = 0; @endphp
                    @if($cartItems->count())
                        @foreach($cartItems as $item)
                            @php
                                $itemTotal = $item->product->price * $item->quantity;
                                $subtotal += $itemTotal;
                            @endphp
                            <div class="order-col">
                                <div>{{ $item->quantity }}x {{ $item->product->name }}</div>
                                <div>Rs. {{ number_format($itemTotal, 2) }}</div>
                            </div>
                        @endforeach
                    @else
                        <p>Your cart is empty.</p>
                    @endif

                    <div class="order-col">
                        <div><strong>Subtotal</strong></div>
                        <div><strong>Rs. {{ number_format($subtotal, 2) }}</strong></div>
                    </div>

                    <div class="order-col">
                        <div>Shipping</div>
                        <div><strong>FREE</strong></div>
                    </div>

                    <div class="order-col">
                        <div><strong>Total</strong></div>
                        <div><strong class="order-total">Rs. {{ number_format($subtotal, 2) }}</strong></div>
                    </div>
                </div>
            </div>

            <!-- CUSTOMER DETAILS -->
            <div class="col-md-7">
                <form action="{{ route('checkout.placeOrder') }}" method="POST">
                    @csrf
                    <div class="billing-details">
                        <h3 class="title">Billing Details</h3>

                        <div class="form-group">
                            <input class="input" type="text" name="name" placeholder="Full Name" required>
                        </div>

                        <div class="form-group">
                            <input class="input" type="email" name="email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <input class="input" type="text" name="phone" placeholder="Phone Number" required>
                        </div>

                        <div class="form-group">
                            <input class="input" type="text" name="address" placeholder="Shipping Address" required>
                        </div>

                        <div class="form-group">
                            <textarea class="input" name="notes" placeholder="Order Notes"></textarea>
                        </div>
                    </div>

                    <!-- PAYMENT -->
                    <div class="payment-method">
                        <h3 class="title">Payment Method</h3>

                        <div class="input-radio">
                            <input type="radio" name="payment_method" id="cash" value="cash" required>
                            <label for="cash"><span></span> Cash on Delivery</label>
                        </div>

                        <div class="input-radio">
                            <input type="radio" name="payment_method" id="esewa" value="esewa" required>
                            <label for="esewa"><span></span> eSewa</label>
                        </div>

                        <div class="input-radio">
                            <input type="radio" name="payment_method" id="khalti" value="khalti" required>
                            <label for="khalti"><span></span> Khalti</label>
                        </div>

                        <button class="primary-btn order-submit">Place Order</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

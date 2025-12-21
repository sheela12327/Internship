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
<!-- ORDER SECTION -->
<div class="section">
    <div class="container">
        <div class="row">

            <!-- ORDER SUMMARY -->
            <div class="col-md-5">
                <div class="order-summary">
                    <h3 class="title">Your Order</h3>

                    <div class="order-products">
                        <div class="order-col">
                            <div>1x Product Name</div>
                            <div>$980.00</div>
                        </div>
                        <div class="order-col">
                            <div>2x Product Name</div>
                            <div>$1960.00</div>
                        </div>
                    </div>

                    <div class="order-col">
                        <div><strong>Subtotal</strong></div>
                        <div><strong>$2940.00</strong></div>
                    </div>

                    <div class="order-col">
                        <div>Shipping</div>
                        <div><strong>FREE</strong></div>
                    </div>

                    <div class="order-col">
                        <div><strong>Total</strong></div>
                        <div>
                            <strong class="order-total">$2940.00</strong>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /ORDER SUMMARY -->

            <!-- CUSTOMER DETAILS -->
            <div class="col-md-7">
                <div class="billing-details">
                    <h3 class="title">Billing Details</h3>

                    <div class="form-group">
                        <input class="input" type="text" placeholder="Full Name">
                    </div>

                    <div class="form-group">
                        <input class="input" type="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <input class="input" type="text" placeholder="Phone Number">
                    </div>

                    <div class="form-group">
                        <input class="input" type="text" placeholder="Shipping Address">
                    </div>

                    <div class="form-group">
                        <textarea class="input" placeholder="Order Notes"></textarea>
                    </div>
                </div>

                <!-- PAYMENT -->
                <div class="payment-method">
                    <h3 class="title">Payment Method</h3>

                    <div class="input-radio">
                        <input type="radio" name="payment" id="cash">
                        <label for="cash">
                            <span></span>
                            Cash on Delivery
                        </label>
                    </div>

                    <div class="input-radio">
                        <input type="radio" name="payment" id="esewa">
                        <label for="esewa">
                            <span></span>
                            eSewa
                        </label>
                    </div>

                    <div class="input-radio">
                        <input type="radio" name="payment" id="khalti">
                        <label for="khalti">
                            <span></span>
                            Khalti
                        </label>
                    </div>

                    <button class="primary-btn order-submit">
                        Place Order
                    </button>
                </div>
                <!-- /PAYMENT -->

            </div>
            <!-- /CUSTOMER DETAILS -->

        </div>
    </div>
</div>
<!-- /ORDER SECTION -->



@endsection
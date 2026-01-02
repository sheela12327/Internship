@extends('template.template')

@section('pagecontent')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Payment Confirmation</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li class="active">Khalti Payment</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <div class="row">
                <!-- Order Details -->
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Your Order</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>
                        <div class="order-products">
                            {{-- Assuming order items are loaded, or we just show total since items logic is handled --}}
                            <div class="order-col">
                                <div>Order ID</div>
                                <div>#{{ $order->id }}</div>
                            </div>
                        </div>
                        <div class="order-col">
                            <div>Shipping</div>
                            <div><strong>FREE</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total">Rs {{ number_format($order->total_amount, 2) }}</strong></div>
                        </div>
                    </div>
                </div>
                <!-- /Order Details -->

                <!-- Billing & Payment -->
                <div class="col-md-7">
                    <div class="section-title">
                        <h3 class="title">Billing Details</h3>
                    </div>
                    <div class="billing-details">
                        <p><strong>Name:</strong> {{ $order->name }}</p>
                        <p><strong>Email:</strong> {{ $order->email }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p><strong>Address:</strong> {{ $order->address }}</p>
                    </div>

                    <div style="margin-top: 30px;">
                        <h4 class="title">Pay with Khalti</h4>
                        <p>You will be redirected to the secure Khalti Payment Gateway to complete your transaction.</p>
                        
                        <form action="{{ route('khalti.payment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                            <input type="hidden" name="amount" value="{{ $order->total_amount * 100 }}"> <!-- Amount in Paisa -->
                            
                            <button type="submit" class="primary-btn order-submit" style="background-color: #5C2D91; border-color: #5C2D91; width: 100%;">
                                Pay with Khalti <i class="fa fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- /Billing & Payment -->
            </div>
        </div>
    </div>
    <!-- /SECTION -->
@endsection

@extends('template.template')

@section('pagecontent')
<div class="container">
    <div class="row">
        <!-- Product Images -->
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
            <!-- If multiple images -->
            @if($product->images)
                <div class="mt-2">
                    @foreach($product->images as $img)
                        <img src="{{ asset('storage/' . $img) }}" width="80">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <h4>Rs. {{ $product->price }}</h4>

            <!-- Add to Cart -->
            <button class="add-to-cart-btn" 
                data-id="{{ $product->id }}" 
                data-name="{{ $product->name }}" 
                data-price="{{ $product->price }}" 
                data-image="{{ $product->image }}">
                <i class="fa fa-shopping-cart"></i> Add to Cart
            </button>
        </div>
    </div>
</div>
@endsection

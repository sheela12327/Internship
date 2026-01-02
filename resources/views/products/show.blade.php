@extends('template.template')

@section('pagecontent')
<div class="container product-page">
    <div class="product-card row align-items-center">

        <!-- Product Images -->
        <div class="col-md-6 product-image-section">
            <div class="main-image">
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="{{ $product->name }}">
            </div>

            @if($product->images)
                <div class="thumbnail-images">
                    @foreach($product->images as $img)
                        <img src="{{ asset('storage/' . $img) }}">
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="col-md-6 product-info-section">

            <span class="product-category">
                {{ $product->category->name ?? 'Product' }}
            </span>

            <h1 class="product-title">{{ $product->name }}</h1>

            <!-- Rating -->
            <div class="product-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
                <span>(4.0)</span>
            </div>

            <h3 class="product-price">Rs. {{ $product->price }}</h3>

            <p class="product-description">
                {{ $product->description }}
            </p>

            <!-- Buttons -->
            <div class="product-actions">
                <button class="add-to-cart-btn"
                        data-id="{{ $product->id }}"
                        data-name="{{ $product->name }}"
                        data-price="{{ $product->price }}"
                        data-image="{{ $product->image }}">
                    <i class="fa fa-shopping-cart"></i> Add to Cart
                </button>

                <button class="wishlist-btn" 
                    data-id="{{ $product->id }}" 
                    data-name="{{ $product->name }}">
                <i class="fa fa-heart"></i>
            </button>
            </div>

        </div>
    </div>
</div>
@endsection

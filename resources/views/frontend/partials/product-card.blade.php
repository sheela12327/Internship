<div class="product">
    <div class="product-img">
        <img src="{{ $product->image
            ? asset('storage/'.$product->image)
            : asset('frontend/img/default.png') }}">
    </div>

    <div class="product-body">
        <p class="product-category">
            {{ $product->category->name ?? '' }}
        </p>

        <h3 class="product-name">
            <a href="{{ route('product.show', $product->id) }}">
                {{ $product->name }}
            </a>
        </h3>

        <h4 class="product-price">
            Rs.{{ $product->price }}
            @if($product->old_price)
                <del class="product-old-price">
                    Rs.{{ $product->old_price }}
                </del>
            @endif
        </h4>
    </div>

    <button class="add-to-cart-btn">
        <i class="fa fa-shopping-cart"></i> add to cart
    </button>
</div>

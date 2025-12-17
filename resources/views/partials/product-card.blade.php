<div class="product">
    <div class="product-img">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        @if($product->is_new)
            <div class="product-label">
                <span class="new">NEW</span>
            </div>
        @endif
    </div>

    <div class="product-body">
        <p class="product-category">{{ $product->category->name }}</p>

        <h3 class="product-name">
            <a href="{{ route('product.show', $product->id) }}">
                {{ $product->name }}
            </a>
        </h3>

        <h4 class="product-price">
            Rs. {{ $product->price }}
            @if($product->old_price)
                <del class="product-old-price">Rs. {{ $product->old_price }}</del>
            @endif
        </h4>

        <div class="product-rating">
            @for($i=1;$i<=5;$i++)
                <i class="fa {{ $i <= $product->rating ? 'fa-star' : 'fa-star-o' }}"></i>
            @endfor
        </div>

        <div class="product-btns d-flex gap-2">

            <!-- Wishlist -->
            <form action="{{ route('wishlist.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="add-to-wishlist">
                    <i class="fa fa-heart-o"></i>
                </button>
            </form>

            <!-- Quick View -->
            <a href="{{ route('product.show', $product->id) }}" class="quick-view">
                <i class="fa fa-eye"></i>
            </a>

        </div>
    </div>

    <!-- Dynamic Product Add to Cart -->
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <button type="button" class="add-to-cart-btn" 
            data-id="{{ $product->id }}">
            <i class="fa fa-shopping-cart"></i> Add to Cart
        </button>
    </form>

</div>

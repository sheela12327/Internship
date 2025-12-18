<div class="product">
    <div class="product-img position-relative">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
        
        @if($product->is_new)
            <div class="product-label position-absolute top-0 start-0 bg-success text-white px-2 py-1">
                NEW
            </div>
        @endif
    </div>

    <div class="product-body mt-2">
        <p class="product-category text-muted small">{{ $product->category->name }}</p>

        <h3 class="product-name h6">
            <a href="{{ route('product.show', $product->id) }}" class="text-dark text-decoration-none">
                {{ $product->name }}
            </a>
        </h3>

        <h4 class="product-price text-primary">
            Rs. {{ $product->price }}
            @if($product->old_price)
                <del class="text-muted ms-2">Rs. {{ $product->old_price }}</del>
            @endif
        </h4>

        <div class="product-rating mb-2">
            @for($i=1;$i<=5;$i++)
                <i class="fa {{ $i <= $product->rating ? 'fa-star text-warning' : 'fa-star-o text-muted' }}"></i>
            @endfor
        </div>

        <div class="product-btns d-flex gap-2">
            <!-- Wishlist Button (AJAX) -->
            <button class="add-to-wishlist btn btn-outline-danger btn-sm p-1" 
                    data-id="{{ $product->id }}" 
                    data-name="{{ $product->name }}">
                <i class="fa fa-heart-o"></i>
            </button>

            <!-- Quick View -->
            <a href="{{ route('product.show', $product->id) }}" class="quick-view btn btn-outline-secondary btn-sm p-1">
                <i class="fa fa-eye"></i>
            </a>
        </div>
    </div>

    <!-- Add to Cart Button (JS handled) -->
    <button type="button"
            class="add-to-cart-btn btn btn-primary btn-block mt-2"
            data-id="{{ $product->id }}"
            data-name="{{ $product->name }}"
            data-price="{{ $product->price }}"
            data-image="{{ asset('storage/' . $product->image) }}">
        <i class="fa fa-shopping-cart"></i> Add to Cart
    </button>
</div>

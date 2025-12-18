<div class="product">
    <div class="product-img position-relative">
        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="img-fluid">

        @if(isset($product['label']))
            <div class="product-label position-absolute top-0 start-0">
                @foreach($product['label'] as $label)
                    <span class="{{ strtolower($label) }} bg-success text-white px-1 py-0 me-1">{{ $label }}</span>
                @endforeach
            </div>
        @endif
    </div>

    <div class="product-body mt-2">
        <p class="product-category text-muted small">{{ $product['category'] }}</p>

        <h3 class="product-name h6">
            <a href="#" class="text-dark text-decoration-none">{{ $product['name'] }}</a>
        </h3>

        <h4 class="product-price text-primary">
            Rs. {{ $product['price'] }}
            @if(isset($product['old_price']))
                <del class="text-muted ms-2">Rs. {{ $product['old_price'] }}</del>
            @endif
        </h4>

        <div class="product-rating mb-2">
            @for($i = 0; $i < 5; $i++)
                <i class="fa fa-star{{ $i < $product['rating'] ? '' : '-o' }} {{ $i < $product['rating'] ? 'text-warning' : 'text-muted' }}"></i>
            @endfor
        </div>

        <div class="product-btns d-flex gap-2">
            <!-- Wishlist -->
            <button class="add-to-wishlist btn btn-outline-danger btn-sm p-1" 
                data-id="{{ $product['id'] ?? 'static-'.$loop->index }}" 
                data-name="{{ $product['name'] }}">
                <i class="fa fa-heart-o"></i>
            </button>

            <!-- Quick View -->
            <button class="quick-view btn btn-outline-secondary btn-sm p-1">
                <i class="fa fa-eye"></i>
            </button>
        </div>
    </div>

    <!-- Cart -->
    <button type="button"
            class="add-to-cart-btn btn btn-primary btn-block mt-2"
            data-id="{{ $product['id'] ?? 'static-'.$loop->index }}"
            data-name="{{ $product['name'] }}"
            data-price="{{ $product['price'] }}"
            data-image="{{ $product['image'] }}">
        <i class="fa fa-shopping-cart"></i> Add to Cart
    </button>
</div>

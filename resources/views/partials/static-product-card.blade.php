<div class="product">
    <div class="product-img">
        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
        @if(isset($product['label']))
            <div class="product-label">
                @foreach($product['label'] as $label)
                    <span class="{{ strtolower($label) }}">{{ $label }}</span>
                @endforeach
            </div>
        @endif
    </div>
    <div class="product-body">
        <p class="product-category">{{ $product['category'] }}</p>
        <h3 class="product-name"><a href="#">{{ $product['name'] }}</a></h3>
        <h4 class="product-price">
            Rs.{{ $product['price'] }}
            @if(isset($product['old_price']))
                <del class="product-old-price">Rs.{{ $product['old_price'] }}</del>
            @endif
        </h4>
        <div class="product-rating">
            @for($i = 0; $i < 5; $i++)
                <i class="fa fa-star{{ $i < $product['rating'] ? '' : '-o' }}"></i>
            @endfor
        </div>
        <div class="product-btns">
            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i></button>
            <button class="add-to-compare"><i class="fa fa-exchange"></i></button>
            <button class="quick-view"><i class="fa fa-eye"></i></button>
        </div>
    </div>
    <!-- Static Product Add to Cart -->
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product['id'] ?? 'static-'.$loop->index }}">
        <input type="hidden" name="name" value="{{ $product['name'] }}">
        <input type="hidden" name="price" value="{{ $product['price'] }}">
        <input type="hidden" name="image" value="{{ $product['image'] }}">
        <button type="button" class="add-to-cart-btn" 
            data-id="{{ $product['id'] ?? 'static-'.$loop->index }}"
            data-name="{{ $product['name'] }}"
            data-price="{{ $product['price'] }}"
            data-image="{{ $product['image'] }}">
            <i class="fa fa-shopping-cart"></i> Add to Cart
        </button>
    </form>

</div>

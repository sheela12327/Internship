<div class="product">
    <div class="product-img">
        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
        @if($product->discount)
            <div class="product-label">
                <span class="sale">-{{ $product->discount }}%</span>
            </div>
        @endif
    </div>
    <div class="product-body">
        <p class="product-category">{{ $product->category->name ?? 'Category' }}</p>
        <h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
        <h4 class="product-price">
            Rs.{{ $product->price }}
            @if($product->old_price)
                <del class="product-old-price">Rs.{{ $product->old_price }}</del>
            @endif
        </h4>
        <div class="product-rating"></div>
        <div class="product-btns">
            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i></button>
            <button class="add-to-compare"><i class="fa fa-exchange"></i></button>
            <button class="quick-view"><i class="fa fa-eye"></i></button>
        </div>
    </div>
    <div class="add-to-cart">
        <button class="add-to-cart-btn" data-id="{{ $product->id }}">
            <i class="fa fa-shopping-cart"></i> Add to cart
        </button>
    </div>
</div>

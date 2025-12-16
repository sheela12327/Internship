@foreach($products as $product)
    <div class="product">
        <div class="product-img">
            <img src="{{ asset('storage/'.$product->image) }}">
        </div>
        <div class="product-body">
            <p>{{ $product->category->name }}</p>
            <h3>
                <a href="{{ route('product.detail',$product->slug) }}">
                    {{ $product->name }}
                </a>
            </h3>
            <h4>Rs. {{ $product->price }}</h4>
        </div>
        <div class="add-to-cart">
            <form method="POST" action="{{ route('cart.add',$product->id) }}">
                @csrf
                <button>Add to cart</button>
            </form>
        </div>
    </div>

@endforeach

{{ $products->links() }}
<img src="{{ asset('storage/'.$product->image) }}">
<h2>{{ $product->name }}</h2>
<p>{{ $product->description }}</p>
<h3>Rs. {{ $product->price }}</h3>
<form method="POST" action="{{ route('cart.add',$product->id) }}">
@csrf
<button>Add to Cart</button>
</form>

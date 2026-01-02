@extends('template.template')

@section('pagecontent')
<div class="container">
    <h2>Search Results for: "{{ $query }}"</h2>
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">${{ $product->price }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No products found.</p>
        @endforelse
    </div>
</div>
@endsection

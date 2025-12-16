@extends('template.template')

@section('pagecontent')
<div class="container mt-5">
    <h2>Your Wishlist</h2>

    @if(count($wishlist) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wishlist as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>
                        @if(isset($item['image']))
                            <img src="{{ asset('storage/'.$item['image']) }}" width="80" alt="{{ $item['name'] }}">
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-danger remove-item" data-id="{{ $id }}">Remove</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Your wishlist is empty.<br> 
        <a href="{{ route('home') }}">Shop Now</a></p>
    @endif
</div>

<script>
document.querySelectorAll('.remove-item').forEach(btn => {
    btn.addEventListener('click', () => {
        const product_id = btn.dataset.id;
        fetch('{{ route("wishlist.remove") }}', {
            method: 'POST',
            headers: {'X-CSRF-TOKEN':'{{ csrf_token() }}','Content-Type':'application/json'},
            body: JSON.stringify({product_id})
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                location.reload();
                updateWishlistCount(data.wishlist_count);
            }
        });
    });
});

// Update wishlist count in header
function updateWishlistCount(count){
    const countElem = document.getElementById('wishlist-count');
    if(countElem) countElem.textContent = count;
}
</script>
@endsection

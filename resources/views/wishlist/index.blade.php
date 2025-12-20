@extends('template.template')

@section('pagecontent')
<div class="container mt-5">
    <h2 class="mb-4">Your Wishlist</h2>

    @if(count($wishlist) > 0)
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wishlist as $id => $item)
                        <tr id="wishlist-item-{{ $id }}">
                            <td>{{ $item['name'] }}</td>
                            <td>
                                @if(isset($item['image']))
                                    <img src="{{ asset('storage/'.$item['image']) }}" width="80" class="img-fluid" alt="{{ $item['name'] }}">
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm remove-item" data-id="{{ $id }}">
                                    <i class="fa fa-trash"></i> Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            Your wishlist is empty.<br>
            <a href="{{ route('home') }}" class="btn btn-primary btn-sm mt-2">Shop Now</a>
        </div>
    @endif
</div>

<script>
document.querySelectorAll('.remove-item').forEach(btn => {
    btn.addEventListener('click', () => {
        const product_id = btn.dataset.id;
        const row = document.getElementById(`wishlist-item-${product_id}`);

        fetch('{{ route("wishlist.remove") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN':'{{ csrf_token() }}',
                'Content-Type':'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ product_id })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                // Remove row from table
                if(row) row.remove();

                // Update wishlist count
                updateWishlistCount(data.wishlist_count);

                // Show success alert
                showAlert('Product removed from wishlist', 'success');

                // If wishlist is empty, show empty message
                if(data.wishlist_count === 0){
                    const container = document.querySelector('.container');
                    container.innerHTML = `
                        <div class="alert alert-info">
                            Your wishlist is empty.<br>
                            <a href="{{ route('home') }}" class="btn btn-primary btn-sm mt-2">Shop Now</a>
                        </div>
                    `;
                }
            } else {
                showAlert('Something went wrong. Please try again.', 'danger');
            }
        })
        .catch(err => {
            console.error(err);
            showAlert('Something went wrong. Please try again.', 'danger');
        });
    });
});

// Update wishlist count in header
function updateWishlistCount(count){
    const countElem = document.getElementById('wishlist-count');
    if(countElem) countElem.textContent = count;
}

// Show temporary alert
function showAlert(message, type='info', duration=2000){
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} position-fixed top-0 end-0 m-3`;
    alertDiv.style.zIndex = 9999;
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);

    setTimeout(() => alertDiv.remove(), duration);
}
</script>
@endsection

@extends('admin.layout')

@section('pagecontent')

<div class="container mt-4">

    <h3 class="mb-3">Product Management</h3>

    <!-- Add Product Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
        + Add Product
    </button>

    <!-- Product Table -->
    <table class="table table-bordered table-striped">
        <thead class="bg-dark text-white">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price (Rs)</th>
                <th>Stock</th>
                <th>Featured</th>
                <th>Hot Deal</th>
                <th>Top Selling</th>
                <th>Action</th>
                <th>Image</th>
            </tr>
            </thead>

            <tbody>
            @foreach($products as $key => $p)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->category->name }}</td>
                <td>{{ $p->price }}</td>
                <td>{{ $p->stock }}</td>

                <td>{!! $p->is_featured ? '✅' : '❌' !!}</td>
                <td>{!! $p->is_hot_deal ? '🔥' : '❌' !!}</td>
                <td>{!! $p->is_top_selling ? '⭐' : '❌' !!}</td>

                <td>
                    <button class="btn btn-sm btn-warning editProductBtn"
                        data-id="{{ $p->id }}"
                        data-name="{{ $p->name }}"
                        data-description="{{ $p->description }}"
                        data-price="{{ $p->price }}"
                        data-stock="{{ $p->stock }}"
                        data-category="{{ $p->category_id }}"
                        data-featured="{{ $p->is_featured }}"
                        data-hot="{{ $p->is_hot_deal }}"
                        data-top="{{ $p->is_top_selling }}"
                        data-image="{{ $p->image }}">
                        Edit
                    </button>

                   <button type="button"
                        class="btn btn-sm btn-danger deleteProductBtn"
                        data-id="{{ $p->id }}">
                        Delete
                    </button>
                </td>

                <td>
                    @if($p->image)
                        <img src="{{ asset('storage/'.$p->image) }}" width="60">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>


    </table>
</div>

<!-- ADD PRODUCT MODAL -->
<div class="modal fade" id="addProductModal">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Add Product</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row">

                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Select</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>Product Type</label><br>
                        <input type="checkbox" name="is_featured"> Featured
                        <input type="checkbox" name="is_hot_deal"> Hot Deal
                        <input type="checkbox" name="is_top_selling"> Top Selling
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Product Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Save</button>
                </div>

            </div>
        </form>
    </div>
</div>


<!-- EDIT PRODUCT MODAL -->
<div class="modal fade" id="editProductModal">
    <div class="modal-dialog modal-lg">
        <form action="" method="POST" id="productEditForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Product</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row">

                    <div class="col-md-6">
                        <label>Name</label>
                        <input type="text" id="edit_name" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Category</label>
                        <select id="edit_category" name="category_id" class="form-control" required>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>Description</label>
                        <textarea id="edit_description" name="description" class="form-control"></textarea>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Price</label>
                        <input type="number" id="edit_price" name="price" class="form-control">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Stock</label>
                        <input type="number" id="edit_stock" name="stock" class="form-control">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>Product Type</label><br>
                        <input type="checkbox" id="edit_featured" name="is_featured"> Featured
                        <input type="checkbox" id="edit_hot" name="is_hot_deal"> Hot Deal
                        <input type="checkbox" id="edit_top" name="is_top_selling"> Top Selling
                    </div>


                    <div class="col-md-12 mt-3">
                        <label>Current Image</label><br>
                        <img id="edit_image_preview" src="" width="100" class="mb-2">
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Change Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // AJAX Add Product
$('#addProductModal form').submit(function(e){
    e.preventDefault(); // prevent normal form submit

    let formData = new FormData(this);

    $.ajax({
        url: "{{ route('admin.products.store') }}",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            // Close modal
            $('#addProductModal').modal('hide');
            $('#addProductModal form')[0].reset();

            // Prepare new table row
            let lastIndex = $('table tbody tr').length + 1;
            let newRow = `
            <tr>
                <td>${lastIndex}</td>
                <td>${response.name}</td>
                <td>${response.category_name}</td>
                <td>${response.price}</td>
                <td>${response.stock}</td>

                <td>${response.is_featured ? '✅' : '❌'}</td>
                <td>${response.is_hot_deal ? '🔥' : '❌'}</td>
                <td>${response.is_top_selling ? '⭐' : '❌'}</td>

                <td>
                    <button class="btn btn-sm btn-warning editProductBtn"
                        data-id="${response.id}"
                        data-name="${response.name}"
                        data-description="${response.description}"
                        data-price="${response.price}"
                        data-stock="${response.stock}"
                        data-category="${response.category_id}"
                        data-featured="${response.is_featured}"
                        data-hot="${response.is_hot_deal}"
                        data-top="${response.is_top_selling}"
                        data-image="${response.image}">
                        Edit
                    </button>

                    <form action="/admin/products/${response.id}" method="POST" class="d-inline">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">

                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this product?')">
                            Delete
                        </button>
                    </form>

                </td>

                <td>
                    ${response.image 
                        ? `<img src="/storage/${response.image}" width="60">` 
                        : '<span class="text-muted">No Image</span>'}
                </td>
            </tr>
            `;


            $('table tbody').append(newRow);

            // Optional: rebind edit button click
            bindEditButtons();
        },
        error: function(err){
            alert('Something went wrong!');
            console.log(err);
        }
    });
});

// Rebind Edit Button click for dynamically added rows
function bindEditButtons(){
    $('.editProductBtn').off('click').on('click', function () {

        let id = $(this).data('id');

        $('#productEditForm').attr(
            'action',
            "{{ url('admin/products') }}/" + id
        );

        $('#edit_name').val($(this).data('name'));
        $('#edit_description').val($(this).data('description'));
        $('#edit_price').val($(this).data('price'));
        $('#edit_stock').val($(this).data('stock'));
        $('#edit_category').val($(this).data('category'));

        $('#edit_featured').prop('checked', $(this).data('featured') == 1);
        $('#edit_hot').prop('checked', $(this).data('hot') == 1);
        $('#edit_top').prop('checked', $(this).data('top') == 1);

        let image = $(this).data('image');
        if(image){
            $('#edit_image_preview').attr('src', '/storage/' + image);
        }else{
            $('#edit_image_preview').attr('src','');
        }

        $('#editProductModal').modal('show');
    });
}
bindEditButtons();

$(document).on('click', '.deleteProductBtn', function () {

    if (!confirm('Delete this product?')) {
        return;
    }

    let button = $(this);
    let productId = button.data('id');

    $.ajax({
        url: "{{ url('admin/products') }}/" + productId,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            _method: "DELETE"
        },
        success: function () {
            button.closest('tr').fadeOut(300, function () {
                $(this).remove();
            });
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            alert('Delete failed');
        }
    });
});
</script>
@endsection

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

                <td>

                    <button class="btn btn-sm btn-warning editProductBtn"
                        data-id="{{ $p->id }}"
                        data-name="{{ $p->name }}"
                        data-description="{{ $p->description }}"
                        data-price="{{ $p->price }}"
                        data-stock="{{ $p->stock }}"
                        data-category="{{ $p->category_id }}"
                        data-image="{{ $p->image }}">
                        Edit
                    </button>

                    <form action="{{ route('admin.products.delete', $p->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this product?')">
                            Delete
                        </button>
                    </form>

                </td>

                <td>
                    @if($p->image)
                        <img src="{{ asset('storage/products/'.$p->image) }}" width="60">
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
                    <td>
                        <button class="btn btn-sm btn-warning editProductBtn"
                            data-id="${response.id}"
                            data-name="${response.name}"
                            data-description="${response.description}"
                            data-price="${response.price}"
                            data-stock="${response.stock}"
                            data-category="${response.category_id}"
                            data-image="${response.image}">
                            Edit
                        </button>
                        <form action="/admin/products/delete/${response.id}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                        </form>
                    </td>
                    <td>
                        ${response.image ? `<img src="/storage/products/${response.image}" width="60">` : '<span class="text-muted">No Image</span>'}
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
        let image = $(this).data('image');

        $('#productEditForm').attr('action', '/admin/products/update/' + id);

        $('#edit_name').val($(this).data('name'));
        $('#edit_description').val($(this).data('description'));
        $('#edit_price').val($(this).data('price'));
        $('#edit_stock').val($(this).data('stock'));
        $('#edit_category').val($(this).data('category'));

        if(image){
            $('#edit_image_preview').attr('src', '/storage/products/' + image);
        } else {
            $('#edit_image_preview').attr('src', '');
        }

        $('#editProductModal').modal('show');
    });
}

// initial bind
bindEditButtons();

</script>
@endsection

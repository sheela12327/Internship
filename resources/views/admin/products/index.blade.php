@extends('admin.layout')

@section('content')

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
                        data-category="{{ $p->category_id }}">
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
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

<!-- ADD PRODUCT MODAL -->
<div class="modal fade" id="addProductModal">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.products.store') }}" method="POST">
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
        <form action="" method="POST" id="productEditForm">
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
    // EDIT PRODUCT BUTTON CLICK
    $(document).on('click', '.editProductBtn', function () {

        let id = $(this).data('id');
        $('#productEditForm').attr('action', "/admin/products/update/" + id);

        $('#edit_name').val($(this).data('name'));
        $('#edit_description').val($(this).data('description'));
        $('#edit_price').val($(this).data('price'));
        $('#edit_stock').val($(this).data('stock'));
        $('#edit_category').val($(this).data('category'));

        $('#editProductModal').modal('show');
    });
</script>
@endsection

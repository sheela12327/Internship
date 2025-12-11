@extends('admin.layout')

@section('content')

<div class="container mt-4">

    <h3 class="mb-3">Category Management</h3>

    <!-- Button to Open Add Modal -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        + Add Category
    </button>

    <!-- Category Table -->
    <table class="table table-bordered table-striped">
        <thead class="bg-dark text-white">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categories as $key => $cat)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->slug }}</td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn"
                        data-id="{{ $cat->id }}"
                        data-name="{{ $cat->name }}">
                        Edit
                    </button>

                    <form action="{{ route('admin.categories.delete', $cat->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Delete this category?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

<!-- ADD CATEGORY MODAL -->
<div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- EDIT CATEGORY MODAL -->
<div class="modal fade" id="editCategoryModal">
    <div class="modal-dialog">
        <form action="" method="POST" id="editForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <label>Name</label>
                    <input type="text" id="edit_name" name="name" class="form-control" required>

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
    // Open Edit Modal and Set Values
    $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');

        $('#edit_name').val(name);

        let updateUrl = "/admin/categories/update/" + id;
        $('#editForm').attr('action', updateUrl);

        $('#editCategoryModal').modal('show');
    });
</script>
@endsection

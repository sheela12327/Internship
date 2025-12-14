@extends('admin.layout')

@section('pagecontent')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Users</h4>
</div>

<div class="content-card">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Total Orders</th>
                <th>Joined</th>
                <th width="180">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($users as $user)
            <tr>
                <td>#{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="badge bg-secondary">
                        {{ $user->orders()->count() }}
                    </span>
                </td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('admin.users.view', $user->id) }}"
                       class="btn btn-sm btn-primary">
                        View
                    </a>

                    <form action="{{ route('admin.users.delete', $user->id) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this user?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">
                    No users found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
</div>
@endsection
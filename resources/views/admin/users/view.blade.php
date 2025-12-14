@extends('admin.layout')

@section('pagecontent')

<a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-secondary mb-3">
    ← Back to Users
</a>

<div class="content-card mb-4">
    <h4>User Details</h4>

    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Joined:</strong> {{ $user->created_at->format('d M Y') }}</p>
</div>

<div class="content-card">
    <h5>User Orders</h5>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @forelse($user->orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>Rs {{ number_format($order->total_amount,2) }}</td>
                <td>
                    <span class="badge bg-{{ 
                        $order->status == 'completed' ? 'success' :
                        ($order->status == 'cancelled' ? 'danger' :
                        ($order->status == 'processing' ? 'info' : 'warning'))
                    }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted">
                    No orders found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

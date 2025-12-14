@extends('admin.layout')

@section('pagecontent')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Orders</h4>
</div>

<div class="content-card">
    <table class="table align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th width="180">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->user->name ?? 'Guest' }}</td>
                <td>Rs {{ number_format($order->total_amount, 2) }}</td>
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
                <td>
                    <a href="{{ route('admin.orders.view', $order->id) }}"
                       class="btn btn-sm btn-primary">
                        View
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted">
                    No orders found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $orders->links() }}
    </div>
</div>

@endsection

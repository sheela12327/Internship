@extends('admin.layout')

@section('pagecontent')

<a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-secondary mb-3">
    ← Back to Orders
</a>

<div class="content-card">

    <h4 class="mb-3">Order #{{ $order->id }}</h4>

    <div class="row mb-4">
        <div class="col-md-6">
            <p><strong>Customer:</strong> {{ $order->user->name }}</p>
            <p><strong>Email:</strong> {{ $order->user->email }}</p>
            <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
        </div>

        <div class="col-md-6">
            <p><strong>Total Amount:</strong> Rs {{ number_format($order->total_amount,2) }}</p>

            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                @csrf

                <label class="fw-bold mb-1">Order Status</label>
                <select name="status" class="form-select w-75 mb-2">
                    @foreach(['pending','processing','completed','cancelled'] as $status)
                        <option value="{{ $status }}"
                            {{ $order->status == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>

                <button class="btn btn-primary btn-sm">
                    Update Status
                </button>
            </form>
        </div>
    </div>

</div>

@endsection

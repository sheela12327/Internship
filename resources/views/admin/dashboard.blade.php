@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-12 gap-6">

    <!-- Stats Cards -->
    <div class="col-span-12 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="p-6 bg-white shadow rounded-lg">
            <h3 class="text-gray-600">Total Users</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalUsers }}</p>
        </div>
        <div class="p-6 bg-white shadow rounded-lg">
            <h3 class="text-gray-600">Total Sales</h3>
            <p class="text-3xl font-bold mt-2">${{ number_format($totalSales, 2) }}</p>
        </div>
        <div class="p-6 bg-white shadow rounded-lg">
            <h3 class="text-gray-600">Orders</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalOrders }}</p>
        </div>
        <div class="p-6 bg-white shadow rounded-lg">
            <h3 class="text-gray-600">Pending Issues</h3>
            <p class="text-3xl font-bold mt-2">{{ $pendingIssues }}</p>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="col-span-12 lg:col-span-8 bg-white p-6 shadow rounded-lg">
        <h3 class="text-xl font-semibold mb-4">Sales Chart</h3>
        <canvas id="salesChart" class="h-64"></canvas>
    </div>

    <!-- Recent Users -->
    <div class="col-span-12 lg:col-span-4 bg-white p-6 shadow rounded-lg">
        <h3 class="text-xl font-semibold mb-4">Recent Users</h3>
        <ul class="space-y-3">
            @foreach($recentUsers as $user)
                <li class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gray-300 rounded-full"></div>
                    <span>{{ $user->name }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Recent Orders Table -->
    <div class="col-span-12 bg-white p-6 shadow rounded-lg">
        <h3 class="text-xl font-semibold mb-4">Recent Orders</h3>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="p-3">Order ID</th>
                    <th class="p-3">Customer</th>
                    <th class="p-3">Amount</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $order)
                <tr class="border-b">
                    <td class="p-3">#{{ $order->id }}</td>
                    <td class="p-3">{{ $order->user->name }}</td>
                    <td class="p-3">${{ number_format($order->amount, 2) }}</td>
                    <td class="p-3">
                        @if($order->status === 'completed')
                            <span class="text-green-600">Completed</span>
                        @elseif($order->status === 'pending')
                            <span class="text-yellow-600">Pending</span>
                        @else
                            <span class="text-red-600">Cancelled</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('salesChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($salesChart->pluck('month')) !!},
            datasets: [{
                label: 'Monthly Sales',
                data: {!! json_encode($salesChart->pluck('total')) !!},
                borderWidth: 2
            }]
        }
    });
</script>


@endsection
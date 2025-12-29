<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans; }
        table { width:100%; border-collapse:collapse; }
        th, td { border:1px solid #000; padding:8px; }
    </style>
</head>
<body>

<h2>Invoice</h2>

<p><b>Order ID:</b> #{{ $order->id }}</p>
<p><b>Customer:</b> {{ $order->user->name }}</p>
<p><b>Date:</b> {{ $order->created_at->format('d M Y') }}</p>

<table>
<thead>
<tr>
    <th>Product</th>
    <th>Qty</th>
    <th>Price</th>
</tr>
</thead>
<tbody>
@foreach($order->items as $item)
<tr>
    <td>{{ $item->product->name }}</td>
    <td>{{ $item->quantity }}</td>
    <td>Rs. {{ $item->price }}</td>
</tr>
@endforeach
</tbody>
</table>

<h3>Total: Rs. {{ $order->total_amount }}</h3>

</body>
</html>

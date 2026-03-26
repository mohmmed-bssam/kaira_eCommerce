@extends('front.layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Order Tracking</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Order #:</strong> {{ $order->id }}</p>
            <p><strong>Order Status:</strong> {{ ucfirst($order->order_status) }}</p>
            <p><strong>Tracking Number:</strong> {{ $order->tracking?->tracking_number ?? 'N/A' }}</p>
            <p><strong>Shipping Company:</strong> {{ $order->tracking?->shipping_company ?? 'N/A' }}</p>
            <p><strong>Delivery Date:</strong> {{ $order->tracking?->delivery_date ?? 'Not set' }}</p>
            <p><strong>Last Status Update:</strong> {{ $order->tracking?->status_date ?? 'N/A' }}</p>
        </div>
    </div>

    <h4 class="mb-3">Order Items</h4>
    <div class="card">
        <div class="card-body">
            @if($order->items->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product->title_trans ?? 'Product deleted' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection

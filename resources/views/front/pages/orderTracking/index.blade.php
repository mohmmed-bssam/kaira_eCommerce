@extends('front.layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">My Orders</h2>

    @if($orders->count())
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tracking #</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>${{ number_format($order->total_price, 2) }}</td>
                            <td>{{ ucfirst($order->order_status) }}</td>
                            <td>{{ $order->tracking?->tracking_number ?? 'N/A' }}</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('front.pages.order-tracking.show', $order) }}" class="btn btn-dark btn-sm">
                                    View Tracking
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>You have no orders yet.</p>
    @endif
</div>
@endsection

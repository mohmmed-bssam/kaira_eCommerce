<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderTrackingController extends Controller
{
    public function index()
    {
        $orders = Order::with(['tracking'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('front.pages.orderTracking.index', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);

        $order->load(['items.product', 'tracking']);

        return view('front.pages.orderTracking.show', compact('order'));
    }
}

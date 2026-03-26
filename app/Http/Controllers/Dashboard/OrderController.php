<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

use function Flasher\Prime\flash;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('user')
            ->latest()
            ->paginate(env('PAGE_SIZE'));

        return view('dashboard.orders.index', compact('orders'));
        }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'payment', 'tracking']);
        return view('dashboard.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        if ($order->order_status === 'delivered') {
            return back()->with('error', 'Delivered orders cannot be modified.');
        }
        $request->validate([
            'order_status' => 'required|string',
            'payment_status' => 'required|string',
        ]);

        $order->update([
            'order_status' => $request->order_status,
            'payment_status' => $request->payment_status,
        ]);
        $order->tracking()->latest()->first()?->update(
            [
                'status' => $request->order_status,
                'status_date' => now(),
            ]
        );
        flash()->info('order status updated successfully ✅');
        return redirect()->route('dashboard.orders.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        flash()->warning('order deleted successfully ✅');
        return redirect()->route('dashboard.orders.index');
    }
}
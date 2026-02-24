<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTracking;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function store(Request $request, Order $order)
    {
        $request->validate([
            'tracking_number' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'shipping_company' => 'nullable|string|max:255',
            'delivery_date' => 'nullable|date',
        ]);

        $order->trackings()->create([
            'tracking_number' => $request->tracking_number,
            'status' => $request->status,
            'shipping_company' => $request->shipping_company,
            'delivery_date' => $request->delivery_date,
            'status_date' => now(),
        ]);


        flash()->success('Tracking status added successfully ✅');
        return redirect()->back();
    }

    public function destroy(Order $order, OrderTracking $tracking)
    {
        $tracking->delete();
        flash()->warning('Tracking status deleted successfully ✅');
        return redirect()->back();
    }
}
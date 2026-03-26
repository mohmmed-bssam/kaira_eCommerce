<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderTracking;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'tracking_number' => ['nullable', 'string', 'max:255'],
            'shipping_company' => ['nullable', 'string', 'max:255'],
            'delivery_date' => ['nullable', 'date'],
        ]);

        $tracking = $order->tracking()->latest();

        if (!$tracking) {
            $tracking = $order->trackings()->create([
                'tracking_number' => $data['tracking_number'] ?? ('TRK-' . strtoupper(uniqid())),
                'shipping_company' => $data['shipping_company'] ?? null,
                'delivery_date' => $data['delivery_date'] ?? null,
                'status_date' => now(),
            ]);
        } else {
            $tracking->update([
                'tracking_number' => $data['tracking_number'],
                'shipping_company' => $data['shipping_company'],
                'delivery_date' => $data['delivery_date'],
                'status_date' => now(),
            ]);
        }



        return back()->with('success', 'Tracking updated successfully.');
    }

    public function destroy(Order $order, OrderTracking $tracking)
    {
        $tracking->delete();
        flash()->warning('Tracking status deleted successfully ✅');
        return redirect()->back();
    }
}
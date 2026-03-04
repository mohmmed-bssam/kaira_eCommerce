<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Massage;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'orders_total' => Order::count(),
            'orders_pending' => Order::where('order_status', 'pending')->count(),
            'orders_delivered' => Order::where('order_status', 'delivered')->count(),
            'products_total' => Product::count(),
            'products_low_stock' => Product::where('stock', '<', 5)->count(),
            'customers_total' => User::where('role', 'customer')->count(),
            'messages_total' => Massage::count(),
        ];

        $latestOrders = Order::with('user')->latest()->take(5)->get();

        return view('dashboard.index', compact('stats', 'latestOrders'));
    }

    public function settings()
    {
        return view('dashboard.settings');
    }
    public function settings_update(Request $request)
    {
        $data = $request->except(['_token', '_method', 'site_logo']);
        if ($request->hasFile('site_logo')) {
            $data['site_logo'] =  $request->file('site_logo')
                ->store('uploads/settings', 'custom');
        }

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        flash()->success('Settings updated successfully');

        return redirect()->back();
    }
    public function messages()
    {
        $messages = Massage::latest()->paginate(env('PAGE_SIZE'));
        return view('dashboard.messages', compact('messages'));
    }
    public function delete_messages($id)
    {
        $message = Massage::findOrFail($id);
        $message->delete();

        flash()->warning('the Massages Deleted!');
        return redirect()->back();
    }
    public function subscriptions()
    {
        $subscriptions = Subscription::latest()->paginate(env('PAGE_SIZE'));
        return view('dashboard.subscriptions', compact('subscriptions'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function checkout(Order $order)
    {
        if ($order->payment->payment_gateway == 'stripe') {
            return $this->stripe($order);
        }

        if ($order->payment->payment_gateway == 'paypal') {
            // return $this->paypal($order);
        }
    }

    public function success(Order $order)
    {
        $order->update([
            'order_status' => 'processing'
        ]);

        $order->payment->update([
            'payment_status' => 'paid'
        ]);

        return view('front.pages.payments.order_success', compact('order'));    }

    public function cancel(Order $order)
    {
        $order->payment->update([
            'payment_status' => 'failed'
        ]);

        return redirect()->route('cart.index');
    }
    public function stripe(Order $order)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Order #' . $order->id,
                    ],
                    'unit_amount' => $order->total_price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('front.payment.success', $order),
            'cancel_url' => route('front.payment.cancel', $order),
        ]);

        return redirect($session->url);
    }
}
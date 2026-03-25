<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderTracking;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
// use PayPalCheckoutSdk\Orders\OrdersCreateRequest;


use function Flasher\Prime\flash;

class CheckoutController extends Controller
{

    public function index()
    {
        $cart = Auth::user()->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty() || $cart = null) {
            return redirect()->route('front.home');
        }

        return view('front.pages.checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $cart = $user->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            flash()->error('Cart is empty');
            return back();
        }

        DB::beginTransaction();

        try {

            // حساب التوتال
            $total = $cart->items->sum(fn($item) => $item->price * $item->quantity);

            // إنشاء الطلب
            $order = Order::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'shipping_address' => $request->address,
                'total_price' => $total,
                'payment_status' => 'pending',
                'order_status' => 'pending'
            ]);

            // إنشاء عناصر الطلب
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price
                ]);
                // خصم المخزون
                $product = $item->product;
                $product->decrement('stock', $item->quantity);
                // زيادة المبيعات
                $product->increment('sales_count', $item->quantity);
            }
            $paymentMethod = $request->payment_method;
            // إنشاء الدفع
            Payment::create([
                'order_id' => $order->id,
                'user_id' => $user->id,
                'amount' => $total,
                'payment_gateway' => $paymentMethod,
                'payment_status' => 'pending'
            ]);
            OrderTracking::create([
                'order_id' => $order->id,
                'status' => 'pending', // أو processing حسب منطقك
                'tracking_number' => 'TRK-' . strtoupper(uniqid()),
                'shipping_company' => 'N/A',
                'delivery_date' => null,
                'status_date' => now(),
            ]);

            // حذف السلة وعناصر السلة
            $cart->items()->delete();
            $cart->delete();
            if ($paymentMethod == 'cash') {
                DB::commit();
                flash()->success('Order placed successfully');
                 return redirect()->route('front.payment.success', $order);
            }

            DB::commit();

            return redirect()->route('front.payment.checkout', $order);
        } catch (\Exception $e) {

            DB::rollBack();
            flash()->error('Something went wrong: ' . $e->getMessage());
            return back();
        }
    }
}

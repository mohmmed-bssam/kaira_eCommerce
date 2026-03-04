<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function customers()
    {
        $customers = User::with('payments')->where('role', 'customer')->latest()
            ->paginate(env('PAGE_SIZE'));
        return view('dashboard.payments.customers', compact('customers'));
    }
    public function payments()
    {
        $payments = Payment::with(['user', 'order'])
            ->latest()
            ->paginate(env('PAGE_SIZE'));
        return view('dashboard.payments.index', compact('payments'));
    }
}
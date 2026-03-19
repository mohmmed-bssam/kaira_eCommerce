@extends('front.layouts.app')

@section('content')
    <div class="container py-5">

        <div class="row">

            <div class="col-md-7">

                <h3>Billing Details</h3>

                <form action="{{ route('front.checkout.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}">
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', Auth::user()->email) }}">
                    </div>

                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>

                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <h5 class="mt-4">Payment Method</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" value="stripe" required>
                            <label class="form-check-label">
                                Pay with Credit Card (Stripe)
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" value="paypal">
                            <label class="form-check-label">
                                Pay with PayPal
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" value="cash" checked>
                            <label class="form-check-label">
                                Cash on Delivery
                            </label>
                        </div>

                    </div>

                    <button class="btn btn-dark" type="submit">
                        Place Order
                    </button>

                </form>

            </div>

            <div class="col-md-5">

                <h3>Your Order</h3>

                <ul class="list-group">

                    @foreach ($cart->items as $item)
                        <li class="list-group-item d-flex justify-content-between">

                            <span>{{ $item->product->title_trans ?? 'Deleted product' }}</span>

                            <span>${{ $item->price * $item->quantity }}</span>

                        </li>
                    @endforeach

                    <li class="list-group-item d-flex justify-content-between">

                        <strong>Total</strong>

                        <strong>
                            ${{ $cart->items->sum(fn($i) => $i->price * $i->quantity) }}
                        </strong>

                    </li>

                </ul>

            </div>

        </div>

    </div>
@endsection

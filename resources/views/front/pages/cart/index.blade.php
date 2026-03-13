@extends('front.layouts.app')

@section('title', 'Cart Page')

@section('css')
    <style>
        .cart-toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #e6800c;
            color: white;
            padding: 12px 18px;
            border-radius: 6px;
            opacity: 0;
            transform: translateY(-20px);
            transition: 0.3s;
            z-index: 9999;
            font-size: 14px;
        }

        .cart-toast.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
@endsection

@section('content')

    <div class="container py-5">

        <h2 class="mb-4">Shopping Cart</h2>

        @if ($cart && $cart->items->count())
            <table class="table">

                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($cart->items as $item)
                        <tr id="cart-row-{{ $item->id }}">
                            <td class="d-flex align-items-center gap-3">
                                <img src="{{ $item->product->images->first()->path ?? '' }}" width="60">
                                {{ $item->product->title_trans }}
                            </td>
                            <td>
                                ${{ $item->price }}
                            </td>
                            <td>
                                <div class="quantity-box d-flex align-items-center gap-2">

                                    <button class="btn btn-light border qty-btn" data-id="{{ $item->id }}"
                                        data-type="minus">-</button>

                                    <span class="px-2 quantity-value">{{ $item->quantity }}</span>

                                    <button class="btn btn-light border qty-btn" data-id="{{ $item->id }}"
                                        data-type="plus">+</button>
                                </div>
                            </td>
                            <td id="item-total-{{ $item->id }}">
                                ${{ $item->price * $item->quantity }}
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm remove-btn" data-id="{{ $item->id }}">
                                    Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end">
                <h4>
                    Total:
                    <strong id="cart-total">
                        ${{ $cart->items->sum(fn($i) => $i->price * $i->quantity) }}
                    </strong>
                </h4>

                <a href="{{ route('front.checkout.index') }}" class="btn btn-primary">
                    Proceed to Checkout
                </a>

            </div>
        @else
            <div class="alert alert-info">
                Your cart is empty
            </div>
        @endif

    </div>

@endsection
@section('scripts')
    <script>
        document.querySelectorAll(".remove-btn").forEach(btn => {

            btn.addEventListener("click", function() {

                let itemId = this.dataset.id

                if (!confirm("Remove this product from cart?")) {
                    return
                }

                fetch(`/cart/${itemId}`, {
                        method: "DELETE",

                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(res => res.json())
                    .then(data => {

                        let row = document.getElementById("cart-row-" + itemId)

                        // animation
                        row.style.transition = "0.35s"
                        row.style.opacity = "0"
                        row.style.transform = "translateX(-30px)"

                        setTimeout(() => {
                            row.remove()
                        }, 350)

                        // update totals
                        document.getElementById("cart-total").innerText = "$" + data.cartTotal

                        document.querySelectorAll(".cart-count").forEach(el => {
                            el.innerText = data.cartCount
                        })

                        // toast
                        let toast = document.getElementById("toast-cart")
                        toast.classList.add("show")

                        setTimeout(() => {
                            toast.classList.remove("show")
                        }, 2500)

                    })

            })

        })
    </script>
@endsection

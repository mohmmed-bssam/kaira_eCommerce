<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/SmoothScroll.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/js/script.min.js') }}"></script>
@yield('scripts')
<script>
    document.querySelectorAll(".qty-btn").forEach(btn => {

        btn.addEventListener("click", function() {

            let itemId = this.dataset.id
            let type = this.dataset.type

            fetch("/cart/update-quantity", {

                    method: "POST",

                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },

                    body: JSON.stringify({
                        item_id: itemId,
                        type: type
                    })

                })
                .then(res => res.json())
                .then(data => {

                    // الصف
                    let row = document.getElementById("cart-row-" + itemId)

                    // تحديث الكمية
                    row.querySelector(".quantity-value").innerText = data.quantity

                    // تحديث سعر المنتج
                    document.getElementById("item-total-" + itemId).innerText = "$" + data.itemTotal

                    document.getElementById("mini-cart-total").innerText = "$" + data.cartTotal
                    // تحديث مجموع السلة
                    document.getElementById("cart-total").innerText = "$" + data.cartTotal
                    // تحديث أيقونة السلة
                    document.querySelectorAll(".cart-count").forEach(el => {
                        el.innerText = data.cartCount
                    })
                    let miniQty = document.querySelector(".mini-qty-" + itemId)

                    if (miniQty) {
                        miniQty.innerText = data.quantity
                    }
                })

        })

    })
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.wishlist-toggle').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const productId = this.dataset.productId;
            const heart = this.querySelector('.wishlist-heart');
            const countElement = document.getElementById('wishlist-count');

            fetch(`/wishlist/${productId}/toggle`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Request failed');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'added') {
                    heart.setAttribute('fill', 'red');
                    heart.setAttribute('stroke', 'red');
                } else if (data.status === 'removed') {
                    heart.setAttribute('fill', 'none');
                    heart.setAttribute('stroke', 'black');
                }

                if (countElement) {
                    let currentCount = parseInt(countElement.textContent) || 0;

                    if (data.status === 'added') {
                        countElement.textContent = currentCount + 1;
                    } else if (data.status === 'removed') {
                        countElement.textContent = Math.max(0, currentCount - 1);
                    }
                }
            })
            .catch(error => {
                console.error(error);
                alert('Something went wrong');
            });
        });
    });
});
</script>

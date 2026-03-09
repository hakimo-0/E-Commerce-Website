<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Cart - KIMO SHOP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div id="toast" class="toast"></div>


    <section class="cart-section section-p1">
        <div id="cart-empty" style="display:none; text-align:center; padding:60px 20px;">
            <i class="fa-solid fa-bag-shopping" style="font-size:60px; color:#ddd;"></i>
            <h3 style="margin:20px 0 10px; color:#999;">Your cart is empty</h3>
            <a href="shop.php" class="btn-dark-arrow">
                    <i class="fa-solid fa-bag-shopping"></i> Go Shopping
                </a>        </div>

        <div id="cart-content">
            <table class="cart-table" id="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody id="cart-body"></tbody>
            </table>

            <div class="cart-summary">
                <div class="cart-summary-box">
                    <h3>Order Summary</h3>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="summary-subtotal">$0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span id="summary-shipping">$5.00</span>
                    </div>
                    <div class="summary-row total-row">
                        <span>Total</span>
                        <span id="summary-total">$0.00</span>
                    </div>
                    <button class="checkout-btn" onclick="alert('Checkout coming soon!')">
                        <i class="fa-solid fa-lock"></i> Proceed to Checkout
                    </button>
                    <a href="shop.php" class="continue-shopping">← Continue Shopping</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <a href="index.php" class="logo-nav">KIMO</a>
            <h4>Contact</h4>
            <p><strong>Address:</strong> N 760 bloc 11, Ain Ati 1, Errachidia, Morocco</p>
            <p><strong>Phone:</strong> 06 2222 3656 / (+212) 01 234 6709</p>
            <p><strong>Hours:</strong> 10:00 - 18:00, Mon - Sat</p>
            <div class="follow">
                <h4>Follow Us</h4>
                <div class="icon">
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-pinterest"></i>
                    <i class="fa-brands fa-youtube"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>About</h4>
            <a href="about.php">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="contact.php">Contact Us</a>
        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="login.php">Sign in</a>
            <a href="cart.php">View Cart</a>
            <a href="wishlist.php">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>
        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="img/app.jpg" alt="">
                <img src="img/play.jpg" alt="">
            </div>
            <p>Secured Payment Gateways</p>
            <img src="img/payment.png" alt="">
        </div>
        <div class="copyright">
            <p>@ site web KIMO — All rights reserved</p>
        </div>
    </footer>

    <script>
    function showToast(msg, type = 'success') {
        const toast = document.getElementById('toast');
        toast.textContent = msg;
        toast.className = 'toast show ' + type;
        setTimeout(() => toast.className = 'toast', 2800);
    }

    function renderCart() {
        const cart = JSON.parse(localStorage.getItem('kimo_cart') || '[]');
        const tbody = document.getElementById('cart-body');
        const empty = document.getElementById('cart-empty');
        const content = document.getElementById('cart-content');

        if (cart.length === 0) {
            empty.style.display = 'block';
            content.style.display = 'none';
            return;
        }

        empty.style.display = 'none';
        content.style.display = 'block';
        tbody.innerHTML = '';

        let subtotal = 0;

        cart.forEach((item, idx) => {
            const lineTotal = item.price * item.qty;
            subtotal += lineTotal;
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><img src="${item.img}" alt="${item.name}" style="width:65px;height:65px;object-fit:cover;border-radius:8px;"></td>
                <td><strong>${item.name}</strong><br><small style="color:#999">${item.brand}</small></td>
                <td><span class="size-tag">${item.size}</span></td>
                <td>$${parseFloat(item.price).toFixed(2)}</td>
                <td>
                    <div class="qty-control">
                        <button onclick="changeQty(${idx}, -1)">−</button>
                        <span>${item.qty}</span>
                        <button onclick="changeQty(${idx}, 1)">+</button>
                    </div>
                </td>
                <td><strong>$${lineTotal.toFixed(2)}</strong></td>
                <td>
                    <button class="remove-wish-btn" onclick="removeItem(${idx})">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });

        const shipping = subtotal > 0 ? 5 : 0;
        document.getElementById('summary-subtotal').textContent = '$' + subtotal.toFixed(2);
        document.getElementById('summary-shipping').textContent = '$' + shipping.toFixed(2);
        document.getElementById('summary-total').textContent = '$' + (subtotal + shipping).toFixed(2);
    }

    function changeQty(idx, delta) {
        let cart = JSON.parse(localStorage.getItem('kimo_cart') || '[]');
        cart[idx].qty += delta;
        if (cart[idx].qty <= 0) cart.splice(idx, 1);
        localStorage.setItem('kimo_cart', JSON.stringify(cart));
        updateCartBadge();
        renderCart();
    }

    function removeItem(idx) {
        let cart = JSON.parse(localStorage.getItem('kimo_cart') || '[]');
        cart.splice(idx, 1);
        localStorage.setItem('kimo_cart', JSON.stringify(cart));
        updateCartBadge();
        renderCart();
        showToast('Item removed', 'warn');
    }

    renderCart();
    </script>
</body>
</html>

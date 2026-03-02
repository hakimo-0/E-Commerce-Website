<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>KIMO SHOP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <!-- TOAST -->
    <div id="toast" class="toast"></div>

    <section id="page-header">
        <h2>#stayhome</h2>
        <p>Save more with coupons & up to 70% off!</p>
    </section>

    <section id="product1" class="section-p1">
        <div class="pro-container">
            <?php
            include 'api/db.php';
            $result = mysqli_query($conn, "SELECT * FROM products ORDER BY created_at DESC");
            while ($product = mysqli_fetch_assoc($result)):
            ?>
            <div class="pro" onclick="window.location.href='product.php?id=<?= $product['id'] ?>'">
                <img src="<?= htmlspecialchars($product['main_img']) ?>" alt="Product">
                <div class="des">
                    <span><?= htmlspecialchars($product['brand']) ?></span>
                    <h5><?= htmlspecialchars($product['name']) ?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <h4>$<?= number_format($product['price'], 2) ?></h4>
                </div>
                <!-- Cart + Wishlist buttons -->
                <div class="pro-buttons">
                    <button class="pro-cart-btn" title="Add to Cart"
                        onclick="event.stopPropagation(); quickAddCart(<?= $product['id'] ?>, <?= json_encode($product['name']) ?>, <?= json_encode($product['brand']) ?>, <?= floatval($product['price']) ?>, <?= json_encode($product['main_img']) ?>)">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </button>
                    <button class="pro-wish-btn" title="Add to Wishlist" id="wish-<?= $product['id'] ?>"
                        onclick="event.stopPropagation(); quickWishlist(<?= $product['id'] ?>, <?= json_encode($product['name']) ?>, <?= json_encode($product['brand']) ?>, <?= floatval($product['price']) ?>, <?= json_encode($product['main_img']) ?>, this)">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>

    <section id="pagination" class="section-p1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newsletter</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="img/logo2.png" alt="">
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
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign in</a>
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
            <p>@ site web KIMO etc HTML - CSS Ecomerce template</p>
        </div>
    </footer>

    <script src="script.js"></script>
    <script>
    // ========================
    // TOAST
    // ========================
    function showToast(msg, type = 'success') {
        const toast = document.getElementById('toast');
        toast.textContent = msg;
        toast.className = 'toast show ' + type;
        setTimeout(() => toast.className = 'toast', 2800);
    }

    // ========================
    // QUICK ADD TO CART (no size)
    // ========================
    function quickAddCart(id, name, brand, price, img) {
        let cart = JSON.parse(localStorage.getItem('kimo_cart') || '[]');
        const key = id + '-default';
        const existing = cart.find(i => i.key === key);

        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({ key, id, name, brand, price, img, size: 'Default', qty: 1 });
        }

        localStorage.setItem('kimo_cart', JSON.stringify(cart));
        updateCartBadge();
        showToast('✅ Added to cart!');
    }

    // ========================
    // QUICK WISHLIST
    // ========================
    function quickWishlist(id, name, brand, price, img, btn) {
        let wishlist = JSON.parse(localStorage.getItem('kimo_wishlist') || '[]');
        const idx = wishlist.findIndex(i => i.id === id);
        const icon = btn.querySelector('i');

        if (idx === -1) {
            wishlist.push({ id, name, brand, price, img });
            icon.className = 'fa-solid fa-heart';
            btn.classList.add('active');
            showToast('❤️ Added to wishlist!');
        } else {
            wishlist.splice(idx, 1);
            icon.className = 'fa-regular fa-heart';
            btn.classList.remove('active');
            showToast('💔 Removed from wishlist', 'warn');
        }

        localStorage.setItem('kimo_wishlist', JSON.stringify(wishlist));
        updateWishlistBadge();
    }

    // Mark wishlist items on load
    window.addEventListener('load', () => {
        const wishlist = JSON.parse(localStorage.getItem('kimo_wishlist') || '[]');
        wishlist.forEach(item => {
            const btn = document.getElementById('wish-' + item.id);
            if (btn) {
                btn.querySelector('i').className = 'fa-solid fa-heart';
                btn.classList.add('active');
            }
        });
    });
    </script>
</body>
</html>

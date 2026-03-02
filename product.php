<?php
include 'api/db.php';

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);

if (!$product) {
    header("Location: shop.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title><?= htmlspecialchars($product['name']) ?> - KIMO SHOP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <!-- TOAST NOTIFICATION -->
    <div id="toast" class="toast"></div>

    <section id="prodetails">
        <div class="single-pro-image">
            <img src="<?= htmlspecialchars($product['main_img']) ?>" width="100%" class="MainImg" alt="">
            <div class="small-img-group">
                <?php 
                $thumbs = [$product['thumb1'], $product['thumb2'], $product['thumb3'], $product['thumb4']];
                foreach ($thumbs as $index => $thumb):
                    if (!empty($thumb)):
                ?>
                <div class="small-img-col">
                    <img src="<?= htmlspecialchars($thumb) ?>" 
                         width="100%"
                         class="small-img<?= $index === 0 ? ' active' : '' ?>" 
                         onclick="changeImg(this)" 
                         alt="">
                </div>
                <?php 
                    endif;
                endforeach; 
                ?>
            </div>
        </div>

        <div class="single-pro-details">
            <h6>Home / <?= htmlspecialchars($product['brand']) ?></h6>
            <h4><?= htmlspecialchars($product['name']) ?></h4>
            <h2>$<?= number_format($product['price'], 2) ?></h2>

            <select id="size-select">
                <option value="">Select Size</option>
                <option>XS</option>
                <option>S</option>
                <option>M</option>
                <option>L</option>
                <option>XL</option>
                <option>XXL</option>
            </select>

            <input type="number" id="qty-input" value="1" min="1" max="99">

            <div class="pro-action-btns">
                <button class="normal" id="add-to-cart-btn" onclick="addToCart()">
                    <i class="fa-solid fa-bag-shopping"></i> Add To Cart
                </button>
                <button class="wishlist-toggle-btn" id="wishlist-toggle-btn" onclick="toggleWishlist()">
                    <i class="fa-regular fa-heart" id="wishlist-icon"></i>
                </button>
            </div>

            <h4>Product Details</h4>
            <span><?= nl2br(htmlspecialchars($product['description'])) ?></span>
        </div>
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

    <script>
    // ========================
    // PRODUCT DATA (from PHP)
    // ========================
    const PRODUCT = {
        id:      <?= $product['id'] ?>,
        name:    <?= json_encode($product['name']) ?>,
        brand:   <?= json_encode($product['brand']) ?>,
        price:   <?= floatval($product['price']) ?>,
        img:     <?= json_encode($product['main_img']) ?>
    };

    // ========================
    // IMAGE SWITCHER
    // ========================
    function changeImg(clicked) {
        document.querySelector('.MainImg').src = clicked.src;
        document.querySelectorAll('.small-img').forEach(img => img.classList.remove('active'));
        clicked.classList.add('active');
    }

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
    // CART
    // ========================
    function addToCart() {
        const size = document.getElementById('size-select').value;
        const qty  = parseInt(document.getElementById('qty-input').value) || 1;

        if (!size) {
            showToast('⚠️ Choose a size first!', 'warn');
            return;
        }

        let cart = JSON.parse(localStorage.getItem('kimo_cart') || '[]');
        const key = PRODUCT.id + '-' + size;
        const existing = cart.find(i => i.key === key);

        if (existing) {
            existing.qty += qty;
        } else {
            cart.push({ key, id: PRODUCT.id, name: PRODUCT.name, brand: PRODUCT.brand, price: PRODUCT.price, img: PRODUCT.img, size, qty });
        }

        localStorage.setItem('kimo_cart', JSON.stringify(cart));
        updateCartBadge();
        showToast('✅ Added to cart!');
    }

    // ========================
    // WISHLIST
    // ========================
    function toggleWishlist() {
        let wishlist = JSON.parse(localStorage.getItem('kimo_wishlist') || '[]');
        const idx = wishlist.findIndex(i => i.id === PRODUCT.id);
        const btn  = document.getElementById('wishlist-toggle-btn');
        const icon = document.getElementById('wishlist-icon');

        if (idx === -1) {
            wishlist.push({ id: PRODUCT.id, name: PRODUCT.name, brand: PRODUCT.brand, price: PRODUCT.price, img: PRODUCT.img });
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

    // Check wishlist state on load
    window.addEventListener('load', () => {
        const wishlist = JSON.parse(localStorage.getItem('kimo_wishlist') || '[]');
        if (wishlist.find(i => i.id === PRODUCT.id)) {
            document.getElementById('wishlist-icon').className = 'fa-solid fa-heart';
            document.getElementById('wishlist-toggle-btn').classList.add('active');
        }
    });
    </script>
</body>
</html>

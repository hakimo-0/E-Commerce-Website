<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="wishlist.css">
    <title>My Wishlist - KIMO SHOP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div id="toast" class="toast"></div>

    

    <div class="wishlist-header-row" id="wishlist-actions">
        <h3>Saved Items <span id="wish-count-label"></span></h3>
        <div class="wishlist-bulk-btns">
            <button class="btn-move-all" onclick="moveAllToCart()">
                <i class="fa-solid fa-bag-shopping"></i> Move All to Cart
            </button>
            <button class="btn-clear-all" onclick="clearAllWishlist()">
                <i class="fa-solid fa-trash"></i> Clear All
            </button>
        </div>
    </div>

    <section class="wishlist-section">
        <div id="wishlist-container">
            <div class="wishlist-empty" id="wishlist-empty" style="display:none;">
                <i class="fa-regular fa-heart"></i>
                <h3>Your wishlist is empty</h3>
                <a href="shop.php" class="btn-dark-arrow">
                    <i class="fa-solid fa-bag-shopping"></i> Go Shopping
                </a>
            </div>
            <table class="wishlist-table" id="wishlist-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody id="wishlist-body"></tbody>
            </table>
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

    <script src="script.js"></script>
    <script src="wishlist.js"></script>
</body>
</html>
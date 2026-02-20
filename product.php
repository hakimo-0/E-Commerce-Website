<?php
include 'api/db.php';

// Jib product men DB
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

            <select>
                <option>Select Size</option>
                <option>XL</option>
                <option>XXL</option>
                <option>Large</option>
                <option>Medium</option>
                <option>Small</option>
            </select>

            <input type="number" value="1">
            <button class="normal">Add To Cart</button>

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
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
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
    // Image switcher
    function changeImg(clicked) {
        document.querySelector('.MainImg').src = clicked.src;
        document.querySelectorAll('.small-img').forEach(img => {
            img.classList.remove('active');
        });
        clicked.classList.add('active');
    }
    </script>
</body>
</html>
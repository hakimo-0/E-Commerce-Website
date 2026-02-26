<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- TOP BAR -->
<div id="top-bar">
    <p>Refer a friend & get <span>$30</span> in credits each <i class="fa-solid fa-wand-magic-sparkles"></i></p>
</div>

<!-- MAIN NAVBAR -->
<nav id="modern-header">
    <div class="container-nav">
        <!-- Logo -->
        <a href="index.php" class="logo-nav">KIMO</a>
        
        <!-- Navigation Links -->
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        
        <!-- Right Icons -->
        <div class="nav-icons">
            <button class="icon-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            <button class="icon-btn"><i class="fa-regular fa-user"></i></button>
            <button class="icon-btn"><i class="fa-regular fa-heart"></i></button>
            <a href="cart.php" class="icon-btn cart-icon">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-badge">0</span>
            </a>
        </div>
        
        <!-- Mobile Menu Toggle -->
        <button class="mobile-toggle" id="mobile-toggle">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobile-menu">
    <button class="mobile-close" id="mobile-close">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <ul class="mobile-nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="blog.php">Blog</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</div>

<script>
// Mobile menu toggle
const mobileToggle = document.getElementById('mobile-toggle');
const mobileMenu = document.getElementById('mobile-menu');
const mobileClose = document.getElementById('mobile-close');

if (mobileToggle) {
    mobileToggle.onclick = () => mobileMenu.classList.add('active');
}
if (mobileClose) {
    mobileClose.onclick = () => mobileMenu.classList.remove('active');
}
</script>
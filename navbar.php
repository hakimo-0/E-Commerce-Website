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
            <!-- Search -->
            <button class="icon-btn" id="search-open-btn" title="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

            <!-- User Dropdown -->
            <div class="user-dropdown-wrapper">
                <button class="icon-btn" id="user-btn" title="Account">
                    <i class="fa-regular fa-user"></i>
                </button>
                <div class="user-dropdown" id="user-dropdown">
                    <a href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Sign In</a>
                    <a href="register.php"><i class="fa-solid fa-user-plus"></i> Register</a>
                    <div class="dropdown-divider"></div>
                    <a href="wishlist.php"><i class="fa-regular fa-heart"></i> My Wishlist</a>
                    <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i> My Cart</a>
                    <div class="dropdown-divider"></div>
                    <a href="#"><i class="fa-solid fa-box"></i> My Orders</a>
                </div>
            </div>

            <!-- Wishlist -->
            <button class="icon-btn" id="wishlist-btn" onclick="window.location.href='wishlist.php'" title="Wishlist">
                <i class="fa-regular fa-heart"></i>
                <span class="wishlist-badge" id="wishlist-badge">0</span>
            </button>

            <!-- Cart -->
            <a href="cart.php" class="icon-btn cart-icon" title="Cart">
                <i class="fa-solid fa-bag-shopping"></i>
                <span class="cart-badge" id="cart-badge">0</span>
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

<!-- ============================= -->
<!-- SEARCH OVERLAY                -->
<!-- ============================= -->
<div id="search-overlay">
    <div class="search-overlay-inner">
        <div class="search-overlay-bar">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="search-input" placeholder="Search for products, brands..." autocomplete="off">
            <button id="search-close-btn" title="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div id="search-loading">
            <i class="fa-solid fa-spinner fa-spin"></i> Searching...
        </div>
        <div id="search-results"></div>
        <div id="search-no-results">
            No products found for "<span id="search-term"></span>"
        </div>
    </div>
</div>

<script>
// ===========================
// USER DROPDOWN
// ===========================
const userBtn = document.getElementById('user-btn');
const userDropdown = document.getElementById('user-dropdown');

if (userBtn) {
    userBtn.onclick = (e) => {
        e.stopPropagation();
        userDropdown.classList.toggle('open');
    };
    document.addEventListener('click', () => userDropdown.classList.remove('open'));
}

// ===========================
// MOBILE MENU
// ===========================
const mobileToggle = document.getElementById('mobile-toggle');
const mobileMenu = document.getElementById('mobile-menu');
const mobileClose = document.getElementById('mobile-close');

if (mobileToggle) mobileToggle.onclick = () => mobileMenu.classList.add('active');
if (mobileClose) mobileClose.onclick = () => mobileMenu.classList.remove('active');

// ===========================
// SEARCH OVERLAY
// ===========================
const searchOverlay = document.getElementById('search-overlay');
const searchOpenBtn = document.getElementById('search-open-btn');
const searchCloseBtn = document.getElementById('search-close-btn');
const searchInput = document.getElementById('search-input');
const searchResults = document.getElementById('search-results');
const searchNoResults = document.getElementById('search-no-results');
const searchLoading = document.getElementById('search-loading');
const searchTerm = document.getElementById('search-term');

let searchTimeout;

// Open overlay
searchOpenBtn.onclick = () => {
    searchOverlay.classList.add('active');
    setTimeout(() => searchInput.focus(), 200);
    document.body.style.overflow = 'hidden';
};

// Close overlay
function closeSearch() {
    searchOverlay.classList.remove('active');
    searchInput.value = '';
    searchResults.innerHTML = '';
    searchResults.classList.remove('has-results');
    searchNoResults.style.display = 'none';
    document.body.style.overflow = '';
}

searchCloseBtn.onclick = closeSearch;

// Close on overlay click (outside box)
searchOverlay.onclick = (e) => {
    if (e.target === searchOverlay) closeSearch();
};

// Close on ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeSearch();
});

// Live search while typing
searchInput.addEventListener('input', () => {
    clearTimeout(searchTimeout);
    const q = searchInput.value.trim();

    if (q.length < 2) {
        searchResults.innerHTML = '';
        searchResults.classList.remove('has-results');
        searchNoResults.style.display = 'none';
        searchLoading.style.display = 'none';
        return;
    }

    searchLoading.style.display = 'block';
    searchResults.classList.remove('has-results');
    searchNoResults.style.display = 'none';

    searchTimeout = setTimeout(() => {
        fetch('api/search.php?q=' + encodeURIComponent(q))
            .then(r => r.json())
            .then(data => {
                searchLoading.style.display = 'none';

                if (data.length === 0) {
                    searchResults.innerHTML = '';
                    searchResults.classList.remove('has-results');
                    searchTerm.textContent = q;
                    searchNoResults.style.display = 'block';
                    return;
                }

                searchNoResults.style.display = 'none';
                searchResults.innerHTML = '';

                data.forEach(product => {
                    const item = document.createElement('a');
                    item.href = 'product.php?id=' + product.id;
                    item.className = 'search-result-item';
                    item.innerHTML = `
                        <img src="${product.main_img}" alt="${product.name}" onerror="this.src='img/placeholder.jpg'">
                        <div class="search-result-info">
                            <div class="search-result-brand">${product.brand}</div>
                            <h5>${product.name}</h5>
                            <span>$${parseFloat(product.price).toFixed(2)}</span>
                        </div>
                    `;
                    searchResults.appendChild(item);
                });

                searchResults.classList.add('has-results');
            })
            .catch(() => {
                searchLoading.style.display = 'none';
            });
    }, 350); // wait 350ms after typing stops
});

// ===========================
// WISHLIST BADGE
// ===========================
function updateWishlistBadge() {
    const wishlist = JSON.parse(localStorage.getItem('kimo_wishlist') || '[]');
    const badge = document.getElementById('wishlist-badge');
    if (wishlist.length > 0) {
        badge.textContent = wishlist.length;
        badge.classList.add('show');
    } else {
        badge.classList.remove('show');
    }
}

updateWishlistBadge();

// ===========================
// CART BADGE
// ===========================
function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('kimo_cart') || '[]');
    const total = cart.reduce((sum, item) => sum + (item.qty || 1), 0);
    document.getElementById('cart-badge').textContent = total;
}

updateCartBadge();
</script>

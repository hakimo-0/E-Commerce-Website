<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Shop - KIMO SHOP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .shop-layout {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 0;
            padding: 0 80px 60px;
            align-items: start;
        }
        .shop-sidebar {
            padding: 30px 25px 30px 0;
            position: sticky;
            top: 80px;
        }
        .filter-block {
            margin-bottom: 28px;
            padding-bottom: 25px;
            border-bottom: 1.5px solid #f0f0f0;
        }
        .filter-block h4 {
            font-size: 12px;
            font-weight: 700;
            color: #1a1a1a;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 14px;
        }
        .filter-option {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .filter-option input[type="radio"] {
            accent-color: #12d0d6;
            width: 16px; height: 16px;
            cursor: pointer;
        }
        .filter-option label {
            font-size: 14px;
            color: #555;
            cursor: pointer;
        }
        .price-range-inputs {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-top: 8px;
        }
        .price-range-inputs input {
            width: 78px;
            padding: 8px 10px;
            border: 1.5px solid #e8e8e8;
            border-radius: 8px;
            font-size: 13px;
            font-family: 'Spartan', sans-serif;
            outline: none;
            color: #333;
        }
        .price-range-inputs input:focus { border-color: #12d0d6; }
        .price-range-inputs span { color: #bbb; }
        .btn-apply-price {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            background: #1a1a1a;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Spartan', sans-serif;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-apply-price:hover { background: #12d0d6; }
        .btn-reset-filters {
            width: 100%;
            padding: 10px;
            background: transparent;
            color: #e74c3c;
            border: 1.5px solid #e74c3c;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'Spartan', sans-serif;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }
        .btn-reset-filters:hover { background: #e74c3c; color: #fff; }

        .shop-main {
            padding: 30px 0 30px 30px;
            border-left: 1.5px solid #f0f0f0;
        }
        .shop-topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .shop-topbar p { color: #888; font-size: 14px; margin: 0; }
        .shop-topbar strong { color: #1a1a1a; }
        .topbar-right { display: flex; gap: 12px; align-items: center; }
        .view-toggle { display: flex; gap: 6px; }
        .view-btn {
            width: 36px; height: 36px;
            background: transparent;
            border: 1.5px solid #e8e8e8;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            color: #aaa;
            transition: 0.2s;
            display: flex; align-items: center; justify-content: center;
        }
        .view-btn.active { background: #1a1a1a; color: #fff; border-color: #1a1a1a; }
        .sort-select {
            padding: 10px 14px;
            border: 1.5px solid #e8e8e8;
            border-radius: 8px;
            font-size: 13px;
            font-family: 'Spartan', sans-serif;
            color: #333;
            outline: none;
            cursor: pointer;
            background: #fff;
        }
        .sort-select:focus { border-color: #12d0d6; }

        .active-filters { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 15px; }
        .filter-tag {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 12px; background: #f0f0f0;
            border-radius: 20px; font-size: 12px; font-weight: 600; color: #555;
        }
        .filter-tag button { background: none; border: none; cursor: pointer; color: #999; font-size: 12px; padding: 0; }
        .filter-tag button:hover { color: #e74c3c; }

        .no-results { text-align: center; padding: 80px 20px; grid-column: 1/-1; }
        .no-results i { font-size: 55px; color: #ddd; display: block; margin-bottom: 15px; }
        .no-results h3 { color: #999; }

        /* List view */
        #pro-container.list-view {
            display: flex !important;
            flex-direction: column;
            gap: 15px;
        }
        #pro-container.list-view .pro {
            width: 100% !important;
            max-width: 100% !important;
            height: auto !important;
            min-height: 0 !important;
            flex-direction: row !important;
            margin: 0 !important;
        }
        #pro-container.list-view .pro img {
            width: 130px !important;
            height: 130px !important;
            object-fit: cover !important;
            flex-shrink: 0;
        }
        #pro-container.list-view .pro .des { padding: 5px 15px !important; flex: 1; }

        @media (max-width: 900px) {
            .shop-layout { grid-template-columns: 1fr; padding: 0 20px 40px; }
            .shop-sidebar { position: static; padding: 20px 0; }
            .shop-main { padding: 0; border-left: none; }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div id="toast" class="toast"></div>


    <?php
    include 'api/db.php';
    $all_products = [];
    $result = mysqli_query($conn, "SELECT * FROM products ORDER BY created_at DESC");
    while ($p = mysqli_fetch_assoc($result)) $all_products[] = $p;
    $total_count = count($all_products);

    $brands_result = mysqli_query($conn, "SELECT DISTINCT brand FROM products ORDER BY brand ASC");
    $brands = [];
    while ($b = mysqli_fetch_assoc($brands_result)) $brands[] = $b['brand'];
    ?>

    <div class="shop-layout">

        <!-- SIDEBAR -->
        <aside class="shop-sidebar">
            <div class="filter-block">
                <h4>Brand</h4>
                <div class="filter-option">
                    <input type="radio" name="brand" id="brand-all" value="" checked onchange="applyFilters()">
                    <label for="brand-all">All Brands</label>
                </div>
                <?php foreach ($brands as $brand): ?>
                <div class="filter-option">
                    <input type="radio" name="brand" id="brand-<?= htmlspecialchars($brand) ?>" value="<?= htmlspecialchars($brand) ?>" onchange="applyFilters()">
                    <label for="brand-<?= htmlspecialchars($brand) ?>"><?= htmlspecialchars($brand) ?></label>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="filter-block">
                <h4>Price Range</h4>
                <div class="price-range-inputs">
                    <input type="number" id="price-min" placeholder="Min $" min="0">
                    <span>—</span>
                    <input type="number" id="price-max" placeholder="Max $" min="0">
                </div>
                <button class="btn-apply-price" onclick="applyFilters()">Apply</button>
            </div>

            <div class="filter-block">
                <h4>Rating</h4>
                <div class="filter-option">
                    <input type="radio" name="rating" id="rating-all" value="" checked onchange="applyFilters()">
                    <label for="rating-all">All Ratings</label>
                </div>
                <div class="filter-option">
                    <input type="radio" name="rating" id="rating-5" value="5" onchange="applyFilters()">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>                </div>
                <div class="filter-option">
                    <input type="radio" name="rating" id="rating-4" value="4" onchange="applyFilters()">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i>              </div>
            </div>

            <button class="btn-reset-filters" onclick="resetFilters()">
                <i class="fa-solid fa-rotate-left"></i> Reset Filters
            </button>
        </aside>

        <!-- MAIN -->
        <main class="shop-main">
            <div class="shop-topbar">
                <p>Showing <strong id="results-count"><?= $total_count ?></strong> products</p>
                <div class="topbar-right">
                    <div class="view-toggle">
                        <button class="view-btn active" id="grid-btn" onclick="setView('grid')" title="Grid">
                            <i class="fa-solid fa-grip"></i>
                        </button>
                        <button class="view-btn" id="list-btn" onclick="setView('list')" title="List">
                            <i class="fa-solid fa-list"></i>
                        </button>
                    </div>
                    <select class="sort-select" id="sort-select" onchange="applyFilters()">
                        <option value="newest">Newest First</option>
                        <option value="price-asc">Price: Low to High</option>
                        <option value="price-desc">Price: High to Low</option>
                        <option value="name-asc">Name: A to Z</option>
                        <option value="name-desc">Name: Z to A</option>
                    </select>
                </div>
            </div>

            <div class="active-filters" id="active-filters"></div>

            <div id="product1">
                <div class="pro-container" id="pro-container"></div>
            </div>
        </main>
    </div>


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
    <script>
    const ALL_PRODUCTS = <?= json_encode($all_products) ?>;
    let currentView = 'grid';

    function showToast(msg, type = 'success') {
        const toast = document.getElementById('toast');
        toast.textContent = msg;
        toast.className = 'toast show ' + type;
        setTimeout(() => toast.className = 'toast', 2800);
    }

    function setView(v) {
        currentView = v;
        document.getElementById('pro-container').classList.toggle('list-view', v === 'list');
        document.getElementById('grid-btn').classList.toggle('active', v === 'grid');
        document.getElementById('list-btn').classList.toggle('active', v === 'list');
    }

    function applyFilters() {
        let products = [...ALL_PRODUCTS];

        const brand = document.querySelector('input[name="brand"]:checked')?.value || '';
        if (brand) products = products.filter(p => p.brand === brand);

        const minVal = parseFloat(document.getElementById('price-min').value);
        const maxVal = parseFloat(document.getElementById('price-max').value);
        if (!isNaN(minVal) && minVal) products = products.filter(p => parseFloat(p.price) >= minVal);
        if (!isNaN(maxVal) && maxVal) products = products.filter(p => parseFloat(p.price) <= maxVal);

        const sort = document.getElementById('sort-select').value;
        if (sort === 'price-asc')  products.sort((a,b) => parseFloat(a.price) - parseFloat(b.price));
        if (sort === 'price-desc') products.sort((a,b) => parseFloat(b.price) - parseFloat(a.price));
        if (sort === 'name-asc')   products.sort((a,b) => a.name.localeCompare(b.name));
        if (sort === 'name-desc')  products.sort((a,b) => b.name.localeCompare(a.name));

        renderProducts(products);
        renderTags(brand, minVal, maxVal);
    }

    function resetFilters() {
        document.getElementById('brand-all').checked = true;
        document.getElementById('rating-all').checked = true;
        document.getElementById('price-min').value = '';
        document.getElementById('price-max').value = '';
        document.getElementById('sort-select').value = 'newest';
        applyFilters();
    }

    function renderTags(brand, minVal, maxVal) {
        const c = document.getElementById('active-filters');
        c.innerHTML = '';
        if (brand) c.innerHTML += `<div class="filter-tag">${brand} <button onclick="document.getElementById('brand-all').checked=true;applyFilters()">✕</button></div>`;
        if (!isNaN(minVal) && minVal) c.innerHTML += `<div class="filter-tag">Min $${minVal} <button onclick="document.getElementById('price-min').value='';applyFilters()">✕</button></div>`;
        if (!isNaN(maxVal) && maxVal) c.innerHTML += `<div class="filter-tag">Max $${maxVal} <button onclick="document.getElementById('price-max').value='';applyFilters()">✕</button></div>`;
    }

    function renderProducts(products) {
        const container = document.getElementById('pro-container');
        container.innerHTML = '';
        document.getElementById('results-count').textContent = products.length;

        if (products.length === 0) {
            container.innerHTML = `<div class="no-results"><i class="fa-solid fa-box-open"></i><h3>No products found</h3></div>`;
            return;
        }

        const wishlist = JSON.parse(localStorage.getItem('kimo_wishlist') || '[]');

        products.forEach(product => {
            const inWish = wishlist.find(i => i.id == product.id);
            const div = document.createElement('div');
            div.className = 'pro';
            div.onclick = () => window.location.href = 'product.php?id=' + product.id;
            div.innerHTML = `
                <img src="${product.main_img}" alt="${product.name}" onerror="this.src='img/placeholder.jpg'">
                <div class="des">
                    <span>${product.brand}</span>
                    <h5>${product.name}</h5>
                    <div class="star">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <h4>$${parseFloat(product.price).toFixed(2)}</h4>
                </div>
                <div class="pro-buttons">
                    <button class="pro-cart-btn" title="Add to Cart"
                        onclick="event.stopPropagation(); quickAddCart(${product.id}, ${JSON.stringify(product.name)}, ${JSON.stringify(product.brand)}, ${parseFloat(product.price)}, ${JSON.stringify(product.main_img)})">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </button>
                    <button class="pro-wish-btn ${inWish ? 'active' : ''}" id="wish-${product.id}" title="Wishlist"
                        onclick="event.stopPropagation(); quickWishlist(${product.id}, ${JSON.stringify(product.name)}, ${JSON.stringify(product.brand)}, ${parseFloat(product.price)}, ${JSON.stringify(product.main_img)}, this)">
                        <i class="${inWish ? 'fa-solid' : 'fa-regular'} fa-heart"></i>
                    </button>
                </div>
            `;
            container.appendChild(div);
        });

        // Restore list view if active
        if (currentView === 'list') {
            document.getElementById('pro-container').classList.add('list-view');
        }
    }

    function quickAddCart(id, name, brand, price, img) {
        let cart = JSON.parse(localStorage.getItem('kimo_cart') || '[]');
        const key = id + '-default';
        const existing = cart.find(i => i.key === key);
        if (existing) existing.qty += 1;
        else cart.push({ key, id, name, brand, price, img, size: 'Default', qty: 1 });
        localStorage.setItem('kimo_cart', JSON.stringify(cart));
        updateCartBadge();
        showToast('✅ Added to cart!');
    }

    function quickWishlist(id, name, brand, price, img, btn) {
        let wishlist = JSON.parse(localStorage.getItem('kimo_wishlist') || '[]');
        const idx = wishlist.findIndex(i => i.id == id);
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

    renderProducts(ALL_PRODUCTS);
    </script>
</body>
</html>
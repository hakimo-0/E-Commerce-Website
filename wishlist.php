<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>My Wishlist - KIMO SHOP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div id="toast" class="toast"></div>

    <section id="page-header">
        <h2>❤️ My Wishlist</h2>
        <p>Your saved products</p>
    </section>

    <section class="wishlist-section section-p1">
        <div id="wishlist-container">
            <div class="wishlist-empty" id="wishlist-empty" style="display:none;">
                <i class="fa-regular fa-heart"></i>
                <h3>Your wishlist is empty</h3>
                <a href="shop.php" class="btn-dark-arrow">
                    Go Shopping <i class="fa-solid fa-arrow-right"></i>
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
        <div class="copyright"><p>@ KIMO SHOP</p></div>
    </footer>

    <script>
    function showToast(msg, type = 'success') {
        const toast = document.getElementById('toast');
        toast.textContent = msg;
        toast.className = 'toast show ' + type;
        setTimeout(() => toast.className = 'toast', 2800);
    }

    function renderWishlist() {
        const wishlist = JSON.parse(localStorage.getItem('kimo_wishlist') || '[]');
        const tbody = document.getElementById('wishlist-body');
        const table = document.getElementById('wishlist-table');
        const empty = document.getElementById('wishlist-empty');

        if (wishlist.length === 0) {
            table.style.display = 'none';
            empty.style.display = 'block';
            return;
        }

        table.style.display = 'table';
        empty.style.display = 'none';
        tbody.innerHTML = '';

        wishlist.forEach(item => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><img src="${item.img}" alt="${item.name}" style="width:70px;height:70px;object-fit:cover;border-radius:8px;"></td>
                <td><strong>${item.name}</strong><br><small style="color:#999">${item.brand}</small></td>
                <td><strong>$${parseFloat(item.price).toFixed(2)}</strong></td>
                <td>
                    <button class="btn-dark-arrow" onclick="moveToCart(${item.id})">
                        <i class="fa-solid fa-bag-shopping"></i> Add to Cart
                    </button>
                </td>
                <td>
                    <button class="remove-wish-btn" onclick="removeWishlist(${item.id})">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    function removeWishlist(id) {
        let wishlist = JSON.parse(localStorage.getItem('kimo_wishlist') || '[]');
        wishlist = wishlist.filter(i => i.id !== id);
        localStorage.setItem('kimo_wishlist', JSON.stringify(wishlist));
        updateWishlistBadge();
        renderWishlist();
        showToast('Removed from wishlist', 'warn');
    }

    function moveToCart(id) {
        const wishlist = JSON.parse(localStorage.getItem('kimo_wishlist') || '[]');
        const item = wishlist.find(i => i.id === id);
        if (!item) return;

        let cart = JSON.parse(localStorage.getItem('kimo_cart') || '[]');
        const key = id + '-default';
        const existing = cart.find(i => i.key === key);
        if (existing) { existing.qty += 1; }
        else { cart.push({ key, id: item.id, name: item.name, brand: item.brand, price: item.price, img: item.img, size: 'Default', qty: 1 }); }

        localStorage.setItem('kimo_cart', JSON.stringify(cart));
        updateCartBadge();
        showToast('✅ Added to cart!');
    }

    renderWishlist();
    </script>
</body>
</html>

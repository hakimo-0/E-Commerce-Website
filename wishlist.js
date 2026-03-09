// ===========================
// WISHLIST - wishlist.js
// ===========================

function showToast(msg, type = 'success') {
    const toast = document.getElementById('toast');
    toast.textContent = msg;
    toast.className = 'toast show ' + type;
    setTimeout(() => toast.className = 'toast', 2800);
}

function renderWishlist() {
    const wishlist = JSON.parse(localStorage.getItem('kimo_wishlist') || '[]');
    const tbody    = document.getElementById('wishlist-body');
    const table    = document.getElementById('wishlist-table');
    const empty    = document.getElementById('wishlist-empty');
    const actions  = document.getElementById('wishlist-actions');
    const countLabel = document.getElementById('wish-count-label');

    if (wishlist.length === 0) {
        table.style.display = 'none';
        empty.style.display = 'block';
        actions.classList.remove('visible');
        return;
    }

    table.style.display = 'table';
    empty.style.display = 'none';
    actions.classList.add('visible');
    countLabel.textContent = '(' + wishlist.length + ' items)';
    tbody.innerHTML = '';

    wishlist.forEach(item => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><img src="${item.img}" alt="${item.name}" style="width:70px;height:70px;object-fit:cover;border-radius:10px;"></td>
            <td>
                <strong style="font-size:14px;">${item.name}</strong><br>
                <small style="color:#aaa;">${item.brand}</small>
            </td>
            <td><strong>$${parseFloat(item.price).toFixed(2)}</strong></td>
            <td>
                <button class="btn-dark-arrow" onclick="moveToCart(${item.id})">
                    <i class="fa-solid fa-bag-shopping"></i> Add to Cart
                </button>
            </td>
            <td>
                <button class="remove-wish-btn" onclick="removeWishlist(${item.id})" title="Remove">
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

function moveAllToCart() {
    const wishlist = JSON.parse(localStorage.getItem('kimo_wishlist') || '[]');
    if (wishlist.length === 0) return;

    let cart = JSON.parse(localStorage.getItem('kimo_cart') || '[]');
    wishlist.forEach(item => {
        const key = item.id + '-default';
        const existing = cart.find(i => i.key === key);
        if (existing) { existing.qty += 1; }
        else { cart.push({ key, id: item.id, name: item.name, brand: item.brand, price: item.price, img: item.img, size: 'Default', qty: 1 }); }
    });

    localStorage.setItem('kimo_cart', JSON.stringify(cart));
    updateCartBadge();
    showToast('✅ All items added to cart!');
}

function clearAllWishlist() {
    if (!confirm('Remove all items from your wishlist?')) return;
    localStorage.setItem('kimo_wishlist', '[]');
    updateWishlistBadge();
    renderWishlist();
    showToast('Wishlist cleared', 'warn');
}

// Init
renderWishlist();
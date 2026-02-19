// =============================================
// KIMO SHOP - script.js
// =============================================

// ---- 1. MOBILE MENU ----
document.addEventListener('DOMContentLoaded', function () {
    const bar   = document.getElementById('bar');
    const close = document.getElementById('close');
    const nav   = document.getElementById('navbar');

    if (bar)   bar.addEventListener('click',   () => nav.classList.add('active'));
    if (close) close.addEventListener('click', () => nav.classList.remove('active'));

    // ---- 2. PRODUCT PAGE - Load product from URL ----
    // Kayqra ?id= men URL
    const params  = new URLSearchParams(window.location.search);
    const id      = parseInt(params.get('id'));

    // Ila kayna id o kayna products array
    if (id && typeof products !== 'undefined') {
        const product = products.find(p => p.id === id);

        if (product) {
            // Afichi linfo dyal product
            document.querySelector('.MainImg').src   = product.mainImg;
            document.getElementById('pro-name').textContent  = product.name;
            document.getElementById('pro-price').textContent = product.price;
            document.getElementById('pro-brand').textContent = 'Home / ' + product.brand;
            document.getElementById('pro-desc').textContent  = product.description;

            // Afichi thumbnails
            const thumbsContainer = document.getElementById('thumbs-container');
            thumbsContainer.innerHTML = '';

            product.thumbs.forEach((src, index) => {
                const col = document.createElement('div');
                col.className = 'small-img-col';

                const img = document.createElement('img');
                img.src      = src;
                img.width    = 100;
                img.className = 'small-img' + (index === 0 ? ' active' : '');
                img.onclick  = function () { changeImg(this); };

                col.appendChild(img);
                thumbsContainer.appendChild(col);
            });
        }
    }
});

// ---- 3. IMAGE SWITCHER ----
// (lazem tkoun barra DOMContentLoaded - global function)
function changeImg(clicked) {
    document.querySelector('.MainImg').src = clicked.src;

    document.querySelectorAll('.small-img').forEach(img => {
        img.classList.remove('active');
    });

    clicked.classList.add('active');
}
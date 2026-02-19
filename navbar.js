// navbar.js - Bla fetch, katkhdm dima ✅
document.getElementById('navbar-container').innerHTML = `
<section id="header">
    <a href="index.html"><img src="img/yubix.png" class="logose" alt="Logo"></a>
    <div>
        <ul id="navbar">
            <li><a href="index.html">Home</a></li>
            <li><a href="shop.html">Shop</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li id="lg-bag"><a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li>
            <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
`;

// Mobile menu
const bar = document.getElementById('bar');
const navbar = document.getElementById('navbar');
const close = document.getElementById('close');

if (bar) bar.onclick = () => navbar.classList.add('active');
if (close) close.onclick = () => navbar.classList.remove('active');
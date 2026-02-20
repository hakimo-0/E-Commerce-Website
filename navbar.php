
<section id="header">
    <a href="index.php"><img src="img/kimooo.png"  class="logose" alt="Logo" /></a>
    <div>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a></li>
            <a href="#" id="close"><i class="fa-solid fa-fa-xmark"></i></a>
        </ul>
    </div>
    <div id="mobile">
        <a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>
<script>
// Mobile menu
const bar = document.getElementById('bar');
const navbar = document.getElementById('navbar');
const close = document.getElementById('close');

if (bar) bar.onclick = () => navbar.classList.add('active');
if (close) close.onclick = () => navbar.classList.remove('active');</script>
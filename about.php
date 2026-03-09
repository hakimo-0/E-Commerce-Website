<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>About Us - KIMO SHOP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* ===== ABOUT PAGE ===== */
        .about-hero {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 60%, #12d0d6 100%);
            padding: 100px 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 60px;
            overflow: hidden;
            position: relative;
        }
        .about-hero::before {
            content: 'KIMO';
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 220px;
            font-weight: 800;
            color: rgba(255,255,255,0.04);
            letter-spacing: -10px;
            pointer-events: none;
        }
        .about-hero-text { max-width: 600px; }
        .about-hero-text h1 {
            font-size: 52px;
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 20px;
        }
        .about-hero-text h1 span { color: #12d0d6; }
        .about-hero-text p { color: rgba(255,255,255,0.75); font-size: 17px; margin: 0 0 30px; }
        .about-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(18,208,214,0.15);
            border: 1px solid rgba(18,208,214,0.4);
            color: #12d0d6;
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 25px;
        }
        .about-hero-stats {
            display: flex;
            gap: 50px;
            margin-top: 40px;
        }
        .stat-item { text-align: center; }
        .stat-item h3 {
            font-size: 36px;
            font-weight: 800;
            color: #12d0d6;
            line-height: 1;
        }
        .stat-item p { color: rgba(255,255,255,0.6); font-size: 13px; margin: 6px 0 0; }

        /* STORY */
        .about-story {
            padding: 80px 80px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }
        .story-img {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            height: 450px;
            background: linear-gradient(135deg, #12d0d6, #088178);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .story-img .big-icon {
            font-size: 140px;
            color: rgba(255,255,255,0.2);
        }
        .story-img .overlay-card {
            position: absolute;
            bottom: 25px;
            left: 25px;
            background: #fff;
            padding: 18px 24px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        .overlay-card h4 { font-size: 22px; font-weight: 800; color: #1a1a1a; margin: 0; }
        .overlay-card p { font-size: 13px; color: #888; margin: 4px 0 0; }
        .story-text h2 { font-size: 38px; font-weight: 800; color: #1a1a1a; margin-bottom: 20px; }
        .story-text h2 span { color: #12d0d6; }
        .story-text p { color: #666; font-size: 15px; line-height: 1.9; }

        /* VALUES */
        .about-values {
            background: #f8f8f8;
            padding: 80px;
        }
        .about-values h2 { font-size: 36px; font-weight: 800; text-align: center; margin-bottom: 10px; }
        .about-values > p { text-align: center; color: #888; margin-bottom: 50px; }
        .values-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        .value-card {
            background: #fff;
            border-radius: 16px;
            padding: 40px 30px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #efefef;
        }
        .value-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.08);
        }
        .value-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #12d0d6, #088178);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 28px;
            color: #fff;
        }
        .value-card h4 { font-size: 18px; font-weight: 700; color: #1a1a1a; margin-bottom: 10px; }
        .value-card p { font-size: 14px; color: #888; margin: 0; line-height: 1.7; }

        /* TEAM */
        .about-team {
            padding: 80px;
        }
        .about-team h2 { font-size: 36px; font-weight: 800; text-align: center; margin-bottom: 10px; }
        .about-team > p { text-align: center; color: #888; margin-bottom: 50px; }
        .team-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        .team-card {
            background: #f8f8f8;
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        .team-card:hover { transform: translateY(-5px); }
        .team-avatar {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 70px;
        }
        .team-avatar.c1 { background: linear-gradient(135deg, #667eea, #764ba2); }
        .team-avatar.c2 { background: linear-gradient(135deg, #f093fb, #f5576c); }
        .team-avatar.c3 { background: linear-gradient(135deg, #4facfe, #00f2fe); }
        .team-info { padding: 20px 25px; }
        .team-info h4 { font-size: 17px; font-weight: 700; color: #1a1a1a; margin-bottom: 4px; }
        .team-info span { font-size: 13px; color: #12d0d6; font-weight: 600; }
        .team-social { display: flex; gap: 10px; margin-top: 12px; }
        .team-social a {
            width: 32px; height: 32px;
            background: #1a1a1a;
            color: #fff;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .team-social a:hover { background: #12d0d6; }

        /* TIMELINE */
        .about-timeline {
            background: #1a1a1a;
            padding: 80px;
        }
        .about-timeline h2 { font-size: 36px; font-weight: 800; text-align: center; color: #fff; margin-bottom: 10px; }
        .about-timeline > p { text-align: center; color: rgba(255,255,255,0.5); margin-bottom: 60px; }
        .timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0; bottom: 0;
            width: 2px;
            background: rgba(18,208,214,0.3);
            transform: translateX(-50%);
        }
        .timeline-item {
            display: flex;
            justify-content: flex-end;
            padding-right: calc(50% + 40px);
            margin-bottom: 50px;
            position: relative;
        }
        .timeline-item:nth-child(even) {
            justify-content: flex-start;
            padding-right: 0;
            padding-left: calc(50% + 40px);
        }
        .timeline-dot {
            position: absolute;
            left: 50%;
            top: 20px;
            transform: translateX(-50%);
            width: 16px; height: 16px;
            background: #12d0d6;
            border-radius: 50%;
            border: 3px solid #1a1a1a;
            box-shadow: 0 0 0 3px rgba(18,208,214,0.3);
        }
        .timeline-content {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 20px 25px;
            max-width: 280px;
        }
        .timeline-content h4 { color: #12d0d6; font-size: 13px; font-weight: 700; letter-spacing: 1px; margin-bottom: 6px; }
        .timeline-content p { color: rgba(255,255,255,0.7); font-size: 14px; margin: 0; }

        @media (max-width: 768px) {
            .about-hero { padding: 60px 20px; flex-direction: column; }
            .about-hero-text h1 { font-size: 32px; }
            .about-hero-stats { gap: 25px; }
            .about-story { padding: 50px 20px; grid-template-columns: 1fr; gap: 40px; }
            .about-values { padding: 50px 20px; }
            .values-grid { grid-template-columns: 1fr; }
            .about-team { padding: 50px 20px; }
            .team-grid { grid-template-columns: 1fr; }
            .about-timeline { padding: 50px 20px; }
            .timeline::before { left: 20px; }
            .timeline-item, .timeline-item:nth-child(even) { padding: 0 0 0 55px; justify-content: flex-start; }
            .timeline-dot { left: 20px; }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <!-- HERO -->
    <section class="about-hero">
        <div class="about-hero-text">
            <div class="about-hero-badge">
                <i class="fa-solid fa-star"></i> EST. 2020 — ERRACHIDIA, MOROCCO
            </div>
            <h1>Fashion That <span>Speaks</span> For Itself</h1>
            <p>We're not just a shop — we're a movement. KIMO brings premium streetwear and authentic style to everyone, everywhere.</p>
            <div class="about-hero-stats">
                <div class="stat-item">
                    <h3>5K+</h3>
                    <p>Happy Customers</p>
                </div>
                <div class="stat-item">
                    <h3>200+</h3>
                    <p>Products</p>
                </div>
                <div class="stat-item">
                    <h3>4.9★</h3>
                    <p>Avg. Rating</p>
                </div>
            </div>
        </div>
    </section>

    <!-- STORY -->
    <section class="about-story">
        <div class="story-img">
            <i class="fa-solid fa-shirt big-icon"></i>
            <div class="overlay-card">
                <h4>Since 2020</h4>
                <p>Born in Errachidia 🇲🇦</p>
            </div>
        </div>
        <div class="story-text">
            <h2>The Story <span>Behind</span> KIMO</h2>
            <p>KIMO was born out of a simple idea: great fashion shouldn't cost a fortune. Founded in 2020 in Errachidia, Morocco, we started as a small local shop with a big dream.</p>
            <p style="margin-top:15px;">Today, we deliver premium clothing and accessories across Morocco and beyond. From classic sneakers to the latest streetwear drops, every product in our collection is hand-picked for quality, style, and authenticity.</p>
            <p style="margin-top:15px;">We believe in fashion that empowers — that makes you feel confident walking into any room. That's the KIMO promise.</p>
            <a href="shop.php" style="display:inline-flex; align-items:center; gap:10px; margin-top:25px; background:#1a1a1a; color:#fff; padding:14px 30px; border-radius:8px; text-decoration:none; font-weight:600; font-size:14px; transition:0.3s;" onmouseover="this.style.background='#12d0d6'" onmouseout="this.style.background='#1a1a1a'">
                Shop Our Collection <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <!-- VALUES -->
    <section class="about-values">
        <h2>What We Stand For</h2>
        <p>Our values guide everything we do — from sourcing to shipping.</p>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon"><i class="fa-solid fa-gem"></i></div>
                <h4>Premium Quality</h4>
                <p>Every item is carefully selected and quality-checked before it reaches your door. No compromises.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="fa-solid fa-bolt"></i></div>
                <h4>Fast Delivery</h4>
                <p>We partner with trusted carriers to ensure your order arrives quickly and safely, every time.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h4>Secure Shopping</h4>
                <p>Your data and payments are always protected. Shop with confidence on KIMO.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="fa-solid fa-arrows-rotate"></i></div>
                <h4>Easy Returns</h4>
                <p>Not happy? We offer hassle-free returns within 14 days. No questions asked.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="fa-solid fa-leaf"></i></div>
                <h4>Sustainability</h4>
                <p>We're committed to reducing our footprint with eco-friendly packaging and responsible sourcing.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="fa-solid fa-headset"></i></div>
                <h4>24/7 Support</h4>
                <p>Our team is always here to help. Reach out via chat, email, or phone anytime.</p>
            </div>
        </div>
    </section>

    <!-- TEAM -->
    <section class="about-team">
        <h2>Meet The Team</h2>
        <p>The passionate people behind KIMO.</p>
        <div class="team-grid">
            <div class="team-card">
                <div class="team-avatar c1">👨‍💼</div>
                <div class="team-info">
                    <h4>Abdelhakim K.</h4>
                    <span>Founder & CEO</span>
                    <div class="team-social">
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="team-card">
                <div class="team-avatar c2">👩‍🎨</div>
                <div class="team-info">
                    <h4>Sara M.</h4>
                    <span>Head of Design</span>
                    <div class="team-social">
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-behance"></i></a>
                    </div>
                </div>
            </div>
            <div class="team-card">
                <div class="team-avatar c3">👨‍💻</div>
                <div class="team-info">
                    <h4>Youssef B.</h4>
                    <span>Lead Developer</span>
                    <div class="team-social">
                        <a href="#"><i class="fa-brands fa-github"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TIMELINE -->
    <section class="about-timeline">
        <h2>Our Journey</h2>
        <p>From a small idea to a growing brand.</p>
        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h4>2020 — THE BEGINNING</h4>
                    <p>KIMO opens its first physical store in Errachidia with just 20 products.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h4>2021 — GOING ONLINE</h4>
                    <p>We launch our e-commerce website, reaching customers across Morocco.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h4>2022 — 1000 ORDERS</h4>
                    <p>We hit our first 1,000 orders milestone and expand our product catalog.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h4>2024 — BRAND PARTNERSHIPS</h4>
                    <p>Official partnerships with top brands like Adidas and Nike collections.</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <h4>2025 — 5000+ CUSTOMERS</h4>
                    <p>KIMO reaches 5,000+ happy customers and continues to grow every day.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- NEWSLETTER -->
    

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
            <a href="#">About Us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign in</a>
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
</body>
</html>
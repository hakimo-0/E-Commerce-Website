<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Contact Us - KIMO SHOP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* ===== CONTACT PAGE ===== */
        .contact-hero {
            background: linear-gradient(135deg, #1a1a1a, #2d2d2d);
            padding: 70px 80px;
            text-align: center;
        }
        .contact-hero h2 {
            font-size: 46px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 12px;
        }
        .contact-hero h2 span { color: #12d0d6; }
        .contact-hero p { color: rgba(255,255,255,0.6); font-size: 16px; margin: 0; }

        /* INFO CARDS */
        .contact-info-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            padding: 60px 80px;
            background: #f8f8f8;
        }
        .contact-info-card {
            background: #fff;
            border-radius: 16px;
            padding: 35px 25px;
            text-align: center;
            border: 1px solid #efefef;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .contact-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        }
        .contact-icon {
            width: 65px; height: 65px;
            background: linear-gradient(135deg, #12d0d6, #088178);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            font-size: 26px; color: #fff;
            margin: 0 auto 18px;
        }
        .contact-info-card h4 { font-size: 16px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px; }
        .contact-info-card p { font-size: 14px; color: #888; margin: 0; line-height: 1.7; }
        .contact-info-card a { color: #12d0d6; text-decoration: none; font-weight: 600; font-size: 14px; }

        /* MAIN CONTACT SECTION */
        .contact-main {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 0;
            min-height: 550px;
        }

        /* MAP SIDE */
        .contact-map-side {
            background: #1a1a1a;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .contact-map-side h3 {
            font-size: 28px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 8px;
        }
        .contact-map-side > p { color: rgba(255,255,255,0.5); margin-bottom: 30px; }
        .map-placeholder {
            flex: 1;
            background: rgba(18,208,214,0.08);
            border: 1px solid rgba(18,208,214,0.2);
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 15px;
            padding: 30px;
            margin-bottom: 30px;
            min-height: 220px;
        }
        .map-placeholder i { font-size: 50px; color: #12d0d6; }
        .map-placeholder span { color: rgba(255,255,255,0.6); font-size: 14px; text-align: center; }
        .map-placeholder a {
            background: #12d0d6;
            color: #fff;
            padding: 10px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: 0.3s;
        }
        .map-placeholder a:hover { background: #088178; }
        .hours-list { display: flex; flex-direction: column; gap: 10px; }
        .hour-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .hour-row span:first-child { color: rgba(255,255,255,0.5); font-size: 13px; }
        .hour-row span:last-child { color: #12d0d6; font-size: 13px; font-weight: 600; }

        /* FORM SIDE */
        .contact-form-side {
            padding: 60px;
            background: #fff;
        }
        .contact-form-side h3 {
            font-size: 28px;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 8px;
        }
        .contact-form-side > p { color: #888; margin-bottom: 35px; }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-field { display: flex; flex-direction: column; gap: 8px; }
        .form-field.full { grid-column: 1 / -1; }
        .form-field label { font-size: 13px; font-weight: 600; color: #1a1a1a; }
        .form-field input,
        .form-field textarea,
        .form-field select {
            padding: 13px 16px;
            border: 1.5px solid #e8e8e8;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Spartan', sans-serif;
            color: #333;
            outline: none;
            transition: border 0.3s;
            background: #fafafa;
        }
        .form-field input:focus,
        .form-field textarea:focus,
        .form-field select:focus {
            border-color: #12d0d6;
            background: #fff;
        }
        .form-field textarea { resize: vertical; min-height: 130px; }
        .contact-submit-btn {
            width: 100%;
            padding: 16px;
            background: #1a1a1a;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Spartan', sans-serif;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }
        .contact-submit-btn:hover { background: #12d0d6; }
        .contact-submit-btn.loading { opacity: 0.7; pointer-events: none; }

        /* SUCCESS STATE */
        .form-success {
            display: none;
            text-align: center;
            padding: 60px 20px;
        }
        .form-success i { font-size: 60px; color: #12d0d6; margin-bottom: 20px; }
        .form-success h4 { font-size: 22px; font-weight: 800; color: #1a1a1a; margin-bottom: 10px; }
        .form-success p { color: #888; }

        /* FAQ */
        .contact-faq {
            background: #f8f8f8;
            padding: 80px;
        }
        .contact-faq h2 { font-size: 36px; font-weight: 800; text-align: center; margin-bottom: 10px; }
        .contact-faq > p { text-align: center; color: #888; margin-bottom: 50px; }
        .faq-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; max-width: 900px; margin: 0 auto; }
        .faq-item {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #efefef;
        }
        .faq-q {
            padding: 20px 25px;
            font-size: 14px;
            font-weight: 700;
            color: #1a1a1a;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.2s;
        }
        .faq-q:hover { color: #12d0d6; }
        .faq-q i { font-size: 12px; transition: transform 0.3s; }
        .faq-a {
            display: none;
            padding: 0 25px 20px;
            font-size: 13px;
            color: #888;
            line-height: 1.7;
        }
        .faq-item.open .faq-q i { transform: rotate(180deg); }
        .faq-item.open .faq-a { display: block; }

        #contact-toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #1a1a1a;
            color: #fff;
            padding: 14px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            transform: translateY(80px);
            opacity: 0;
            transition: 0.4s;
            z-index: 9999;
        }
        #contact-toast.show { transform: translateY(0); opacity: 1; }

        @media (max-width: 768px) {
            .contact-hero { padding: 50px 20px; }
            .contact-hero h2 { font-size: 30px; }
            .contact-info-row { grid-template-columns: 1fr; padding: 40px 20px; }
            .contact-main { grid-template-columns: 1fr; }
            .contact-map-side, .contact-form-side { padding: 40px 20px; }
            .form-row { grid-template-columns: 1fr; }
            .contact-faq { padding: 50px 20px; }
            .faq-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div id="contact-toast"></div>

    <!-- HERO -->
    <section class="contact-hero">
        <h2>Get In <span>Touch</span></h2>
        <p>We're here to help. Reach out and we'll get back to you within 24 hours.</p>
    </section>

    <!-- INFO CARDS -->
    <div class="contact-info-row">
        <div class="contact-info-card">
            <div class="contact-icon"><i class="fa-solid fa-location-dot"></i></div>
            <h4>Our Store</h4>
            <p>N 760 bloc 11, Ain Ati 1<br>Errachidia, Morocco</p>
            <a href="https://maps.google.com" target="_blank">Get Directions →</a>
        </div>
        <div class="contact-info-card">
            <div class="contact-icon"><i class="fa-solid fa-phone"></i></div>
            <h4>Call Us</h4>
            <p>06 2222 3656<br>(+212) 01 234 6709</p>
            <a href="tel:+212622223656">Call Now →</a>
        </div>
        <div class="contact-info-card">
            <div class="contact-icon"><i class="fa-regular fa-envelope"></i></div>
            <h4>Email Us</h4>
            <p>support@kimoshop.ma<br>orders@kimoshop.ma</p>
            <a href="mailto:support@kimoshop.ma">Send Email →</a>
        </div>
    </div>

    <!-- MAIN: MAP + FORM -->
    <div class="contact-main">
        <!-- LEFT: Location info -->
        <div class="contact-map-side">
            <div>
                <h3>Find Us Here</h3>
                <p>Visit our store or send us a message online.</p>
                <div class="map-placeholder">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>N 760 bloc 11, Ain Ati 1<br>Errachidia, Morocco</span>
                    <a href="https://www.google.com/maps?q=Errachidia,Morocco" target="_blank">
                        <i class="fa-solid fa-external-link-alt"></i> Open in Google Maps
                    </a>
                </div>
            </div>
            <div>
                <div class="hours-list">
                    <div class="hour-row"><span>Monday – Friday</span><span>10:00 – 18:00</span></div>
                    <div class="hour-row"><span>Saturday</span><span>10:00 – 16:00</span></div>
                    <div class="hour-row"><span>Sunday</span><span>Closed</span></div>
                </div>
            </div>
        </div>

        <!-- RIGHT: Form -->
        <div class="contact-form-side">
            <h3>Send A Message</h3>
            <p>Fill out the form below and we'll respond as soon as possible.</p>

            <div id="contact-form">
                <div class="form-row">
                    <div class="form-field">
                        <label>First Name *</label>
                        <input type="text" id="c-fname" placeholder="Abdelhakim">
                    </div>
                    <div class="form-field">
                        <label>Last Name *</label>
                        <input type="text" id="c-lname" placeholder="Khalid">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label>Email *</label>
                        <input type="email" id="c-email" placeholder="your@email.com">
                    </div>
                    <div class="form-field">
                        <label>Phone</label>
                        <input type="tel" id="c-phone" placeholder="06 XX XX XX XX">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field full">
                        <label>Subject *</label>
                        <select id="c-subject">
                            <option value="">Select a subject...</option>
                            <option>Order Issue</option>
                            <option>Return / Refund</option>
                            <option>Product Question</option>
                            <option>Shipping & Delivery</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field full">
                        <label>Message *</label>
                        <textarea id="c-message" placeholder="Tell us how we can help..."></textarea>
                    </div>
                </div>
                <button class="contact-submit-btn" onclick="submitForm()" id="submit-btn">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span id="submit-text">Send Message</span>
                </button>
            </div>

            <div class="form-success" id="form-success">
                <i class="fa-solid fa-circle-check"></i>
                <h4>Message Sent!</h4>
                <p>Thank you for reaching out. We'll get back to you within 24 hours.</p>
                <button onclick="resetForm()" style="margin-top:20px; padding:12px 28px; background:#1a1a1a; color:#fff; border:none; border-radius:8px; cursor:pointer; font-family:'Spartan',sans-serif; font-weight:600;">Send Another</button>
            </div>
        </div>
    </div>

    <!-- FAQ -->
    <section class="contact-faq">
        <h2>Frequently Asked Questions</h2>
        <p>Quick answers to common questions.</p>
        <div class="faq-grid">
            <div class="faq-item" onclick="toggleFaq(this)">
                <div class="faq-q">How long does delivery take? <i class="fa-solid fa-chevron-down"></i></div>
                <div class="faq-a">Standard delivery takes 2–5 business days within Morocco. Express delivery available at checkout.</div>
            </div>
            <div class="faq-item" onclick="toggleFaq(this)">
                <div class="faq-q">Can I return a product? <i class="fa-solid fa-chevron-down"></i></div>
                <div class="faq-a">Yes! We offer free returns within 14 days of receiving your order, as long as items are unused and in original packaging.</div>
            </div>
            <div class="faq-item" onclick="toggleFaq(this)">
                <div class="faq-q">How do I track my order? <i class="fa-solid fa-chevron-down"></i></div>
                <div class="faq-a">Once shipped, you'll receive a tracking number by email. You can also track directly from your account dashboard.</div>
            </div>
            <div class="faq-item" onclick="toggleFaq(this)">
                <div class="faq-q">What payment methods do you accept? <i class="fa-solid fa-chevron-down"></i></div>
                <div class="faq-a">We accept cash on delivery, bank transfer, and all major credit/debit cards through our secure payment gateway.</div>
            </div>
            <div class="faq-item" onclick="toggleFaq(this)">
                <div class="faq-q">Are your products authentic? <i class="fa-solid fa-chevron-down"></i></div>
                <div class="faq-a">Absolutely. Every product in our catalog is 100% authentic and sourced directly from authorized distributors.</div>
            </div>
            <div class="faq-item" onclick="toggleFaq(this)">
                <div class="faq-q">Do you ship outside Morocco? <i class="fa-solid fa-chevron-down"></i></div>
                <div class="faq-a">Currently we ship within Morocco. International shipping is coming soon — sign up for our newsletter to be notified!</div>
            </div>
        </div>
    </section>

    <!-- NEWSLETTER -->
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
    <script>
    function showCToast(msg, ok = true) {
        const t = document.getElementById('contact-toast');
        t.textContent = msg;
        t.style.background = ok ? '#12d0d6' : '#e74c3c';
        t.classList.add('show');
        setTimeout(() => t.classList.remove('show'), 3000);
    }

    function submitForm() {
        const fname   = document.getElementById('c-fname').value.trim();
        const lname   = document.getElementById('c-lname').value.trim();
        const email   = document.getElementById('c-email').value.trim();
        const subject = document.getElementById('c-subject').value;
        const message = document.getElementById('c-message').value.trim();

        if (!fname || !lname || !email || !subject || !message) {
            showCToast('⚠️ Please fill all required fields', false);
            return;
        }

        const btn = document.getElementById('submit-btn');
        const txt = document.getElementById('submit-text');
        btn.classList.add('loading');
        txt.textContent = 'Sending...';

        // Simulate sending
        setTimeout(() => {
            document.getElementById('contact-form').style.display = 'none';
            document.getElementById('form-success').style.display = 'block';
            showCToast('✅ Message sent successfully!');
        }, 1500);
    }

    function resetForm() {
        document.getElementById('contact-form').style.display = 'block';
        document.getElementById('form-success').style.display = 'none';
        document.getElementById('submit-btn').classList.remove('loading');
        document.getElementById('submit-text').textContent = 'Send Message';
        ['c-fname','c-lname','c-email','c-phone','c-subject','c-message'].forEach(id => {
            document.getElementById(id).value = '';
        });
    }

    function toggleFaq(el) {
        const isOpen = el.classList.contains('open');
        document.querySelectorAll('.faq-item').forEach(f => f.classList.remove('open'));
        if (!isOpen) el.classList.add('open');
    }
    </script>
</body>
</html>
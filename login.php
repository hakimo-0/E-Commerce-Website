<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login - KIMO SHOP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div id="toast" class="toast"></div>

    <section class="auth-section">
        <div class="auth-container">

            <!-- LEFT SIDE - Image/Branding -->
            <div class="auth-left">
                <div class="auth-left-content">
                    <a href="index.php" class="logo-nav" style="color:#fff; font-size:32px;">KIMO</a>
                    <h2>Welcome Back!</h2>
                    <p>Sign in to access your wishlist, orders and more.</p>
                    <div class="auth-features">
                        <div class="auth-feature-item">
                            <i class="fa-solid fa-bag-shopping"></i>
                            <span>Track your orders</span>
                        </div>
                        <div class="auth-feature-item">
                            <i class="fa-regular fa-heart"></i>
                            <span>Save your wishlist</span>
                        </div>
                        <div class="auth-feature-item">
                            <i class="fa-solid fa-tag"></i>
                            <span>Get exclusive deals</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE - Form -->
            <div class="auth-right">
                <!-- TABS -->
                <div class="auth-tabs">
                    <button class="auth-tab active" id="tab-login" onclick="switchTab('login')">Sign In</button>
                    <button class="auth-tab" id="tab-register" onclick="switchTab('register')">Register</button>
                </div>

                <!-- LOGIN FORM -->
                <div class="auth-form" id="form-login">
                    <h3>Sign In</h3>

                    <!-- Google Button -->
                    <button class="social-btn google-btn" onclick="loginWithGoogle()">
                        <img src="https://www.google.com/favicon.ico" alt="Google" width="18">
                        Continue with Google
                    </button>

                    <div class="auth-divider"><span>or</span></div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-icon">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" id="login-email" placeholder="your@email.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="login-password" placeholder="••••••••">
                            <button class="toggle-pass" onclick="togglePass('login-password', this)">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox"> Remember me
                        </label>
                        <a href="#" onclick="forgotPassword()" class="forgot-link">Forgot password?</a>
                    </div>

                    <button class="auth-submit-btn" onclick="loginWithEmail()">
                        <span id="login-btn-text">Sign In</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>

                    <p class="auth-switch">Don't have an account? <a href="#" onclick="switchTab('register')">Register</a></p>
                </div>

                <!-- REGISTER FORM -->
                <div class="auth-form" id="form-register" style="display:none;">
                    <h3>Create Account</h3>

                    <button class="social-btn google-btn" onclick="loginWithGoogle()">
                        <img src="https://www.google.com/favicon.ico" alt="Google" width="18">
                        Continue with Google
                    </button>

                    <div class="auth-divider"><span>or</span></div>

                    <div class="form-group">
                        <label>Full Name</label>
                        <div class="input-icon">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" id="reg-name" placeholder="Abdelhakim...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-icon">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="email" id="reg-email" placeholder="your@email.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="reg-password" placeholder="Min 6 characters">
                            <button class="toggle-pass" onclick="togglePass('reg-password', this)">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button class="auth-submit-btn" onclick="registerWithEmail()">
                        <span id="reg-btn-text">Create Account</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>

                    <p class="auth-switch">Already have an account? <a href="#" onclick="switchTab('login')">Sign In</a></p>
                </div>

            </div>
        </div>
    </section>

    <!-- Firebase SDK -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
        import { 
            getAuth, 
            signInWithPopup, 
            GoogleAuthProvider,
            signInWithEmailAndPassword,
            createUserWithEmailAndPassword,
            updateProfile,
            sendPasswordResetEmail,
            onAuthStateChanged
        } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-auth.js";

        const firebaseConfig = {
            apiKey: "AIzaSyB8Z9pG-wK9GKFMYIvYjshzu8-gbaNms8g",
            authDomain: "kimo-shop-8e36f.firebaseapp.com",
            projectId: "kimo-shop-8e36f",
            storageBucket: "kimo-shop-8e36f.firebasestorage.app",
            messagingSenderId: "1032247102824",
            appId: "1:1032247102824:web:9cd39fd7cf5bbae2ffdadd",
            measurementId: "G-15D1K2KEM5"
        };

        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        const googleProvider = new GoogleAuthProvider();

        // Check if already logged in
        onAuthStateChanged(auth, (user) => {
            if (user) {
                // Save user to localStorage
                localStorage.setItem('kimo_user', JSON.stringify({
                    uid: user.uid,
                    name: user.displayName,
                    email: user.email,
                    photo: user.photoURL
                }));
                // Redirect to home
                window.location.href = 'index.php';
            }
        });

        // ========================
        // GOOGLE LOGIN
        // ========================
        window.loginWithGoogle = async () => {
            try {
                const result = await signInWithPopup(auth, googleProvider);
                showToast('✅ Welcome ' + result.user.displayName + '!');
            } catch (err) {
                showToast('❌ ' + getErrorMsg(err.code), 'warn');
            }
        };

        // ========================
        // EMAIL LOGIN
        // ========================
        window.loginWithEmail = async () => {
            const email    = document.getElementById('login-email').value.trim();
            const password = document.getElementById('login-password').value;
            const btnText  = document.getElementById('login-btn-text');

            if (!email || !password) {
                showToast('⚠️ Fill in all fields', 'warn');
                return;
            }

            btnText.textContent = 'Signing in...';

            try {
                await signInWithEmailAndPassword(auth, email, password);
                showToast('✅ Welcome back!');
            } catch (err) {
                btnText.textContent = 'Sign In';
                showToast('❌ ' + getErrorMsg(err.code), 'warn');
            }
        };

        // ========================
        // REGISTER
        // ========================
        window.registerWithEmail = async () => {
            const name     = document.getElementById('reg-name').value.trim();
            const email    = document.getElementById('reg-email').value.trim();
            const password = document.getElementById('reg-password').value;
            const btnText  = document.getElementById('reg-btn-text');

            if (!name || !email || !password) {
                showToast('⚠️ Fill in all fields', 'warn');
                return;
            }

            if (password.length < 6) {
                showToast('⚠️ Password min 6 characters', 'warn');
                return;
            }

            btnText.textContent = 'Creating...';

            try {
                const result = await createUserWithEmailAndPassword(auth, email, password);
                await updateProfile(result.user, { displayName: name });
                showToast('✅ Account created! Welcome ' + name + '!');
            } catch (err) {
                btnText.textContent = 'Create Account';
                showToast('❌ ' + getErrorMsg(err.code), 'warn');
            }
        };

        // ========================
        // FORGOT PASSWORD
        // ========================
        window.forgotPassword = async () => {
            const email = document.getElementById('login-email').value.trim();
            if (!email) {
                showToast('⚠️ Enter your email first', 'warn');
                return;
            }
            try {
                await sendPasswordResetEmail(auth, email);
                showToast('📧 Reset email sent!');
            } catch (err) {
                showToast('❌ ' + getErrorMsg(err.code), 'warn');
            }
        };

        // ========================
        // ERROR MESSAGES
        // ========================
        function getErrorMsg(code) {
            const msgs = {
                'auth/user-not-found':      'No account with this email',
                'auth/wrong-password':      'Wrong password',
                'auth/email-already-in-use':'Email already used',
                'auth/invalid-email':       'Invalid email',
                'auth/weak-password':       'Password too weak',
                'auth/popup-closed-by-user':'Login cancelled',
                'auth/too-many-requests':   'Too many attempts, try later',
            };
            return msgs[code] || 'An error occurred';
        }
    </script>

    <script>
    // ========================
    // UI FUNCTIONS
    // ========================
    function showToast(msg, type = 'success') {
        const toast = document.getElementById('toast');
        toast.textContent = msg;
        toast.className = 'toast show ' + type;
        setTimeout(() => toast.className = 'toast', 2800);
    }

    function switchTab(tab) {
        document.getElementById('form-login').style.display    = tab === 'login'    ? 'block' : 'none';
        document.getElementById('form-register').style.display = tab === 'register' ? 'block' : 'none';
        document.getElementById('tab-login').classList.toggle('active',    tab === 'login');
        document.getElementById('tab-register').classList.toggle('active', tab === 'register');
    }

    function togglePass(id, btn) {
        const input = document.getElementById(id);
        const icon  = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fa-regular fa-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'fa-regular fa-eye';
        }
    }

    // Enter key support
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            const loginForm = document.getElementById('form-login');
            if (loginForm.style.display !== 'none') loginWithEmail();
            else registerWithEmail();
        }
    });
    </script>
</body>
</html>

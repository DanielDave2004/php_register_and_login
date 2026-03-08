<?php
session_start();

// Already logged in? Go to dashboard
if (isset($_SESSION['username'])) {
    header('Location: pages/dashboard.php');
    exit;
}

$panel = $_GET['panel'] ?? 'login';
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en" id="htmlRoot">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>McDollibee</title>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Nunito:wght@400;600;700;800;900&family=Boogaloo&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

    <!-- ══════════════════════════════════════
        NAVBAR
    ══════════════════════════════════════ -->
    <nav class="navbar">
        <div class="nav-brand">
            <img src="assets/mcdolibee_logo.png" alt="McDollibee Logo" class="nav-logo"/>
            <span class="brand-text">Mc<span class="brand-yellow">Dollibee</span></span>
        </div>
        <ul class="nav-links">
            <li><a href="#home"    class="nav-link">Home</a></li>
            <li><a href="#menu"    class="nav-link">Menu</a></li>
            <li><a href="#about"   class="nav-link">About</a></li>
            <li><a href="#contact" class="nav-link">Contact</a></li>
        </ul>
        <div class="nav-actions">
            <button id="themeToggle" class="theme-btn" title="Switch to Dark Mode">
                <i id="themeIcon" class="fa-solid fa-sun"></i>
            </button>
            <button id="openLogin"    class="btn-login">Login</button>
            <button id="openRegister" class="btn-register">Register</button>
        </div>
        <button id="hamburger" class="hamburger">
            <i class="fa-solid fa-bars"></i>
        </button>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu">
        <a href="#home">Home</a>
        <a href="#menu">Menu</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
    </div>

    <!-- ══════════════════════════════════════
        HERO
    ══════════════════════════════════════ -->
    <section id="home" class="hero">
        <div class="hero-content">
            <div class="hero-badge">New Items Available</div>
            <h1 class="hero-title animate-slide-up">
                Hunger Stops<br/>
                <span class="hero-highlight">Here.</span>
            </h1>
            <p class="hero-sub animate-slide-up delay-200">
                Crispy, juicy, golden perfection — delivered to your door faster than you can say "Supersize it."
            </p>
            <div class="hero-btns animate-slide-up delay-300">
                <button id="orderNow" class="btn-primary">
                    Order Now <i class="fa-solid fa-arrow-right"></i>
                </button>
                <button class="btn-outline">Explore Menu</button>
            </div>
            <div class="hero-stats animate-slide-up delay-400">
                <div class="stat">
                    <span class="stat-num">50+</span>
                    <span class="stat-label">Menu Items</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat">
                    <span class="stat-num">4.9★</span>
                    <span class="stat-label">Rating</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat">
                    <span class="stat-num">30min</span>
                    <span class="stat-label">Delivery</span>
                </div>
            </div>
        </div>
        <div class="hero-image">
            <div class="hero-glow"></div>
            <img src="assets/burger.png" alt="Burger" class="hero-burger"/>
        </div>
    </section>

    <!-- ══════════════════════════════════════
        MENU
    ══════════════════════════════════════ -->
    <section id="menu" class="section menu-section">
        <div class="section-header">
            <span class="section-tag">Our Specialties</span>
            <h2 class="section-title">Fan <span class="text-yellow stroke-red">Favorites</span></h2>
            <p class="section-sub">Crafted with love, served with speed.</p>
        </div>
        <div class="menu-grid">

            <div class="menu-card reveal">
                <div class="menu-img-wrap">
                    <img src="assets/burger.png" alt="Burger"/>
                </div>
                <h3>Burger</h3>
                <p>Double smashed beef patty, special sauce, pickles, onion rings.</p>
                <div class="menu-footer">
                    <span class="price">₱199</span>
                    <button class="btn-add">Add +</button>
                </div>
            </div>

            <div class="menu-card reveal">
                <div class="menu-img-wrap">
                    <img src="assets/chicken.png" alt="Chicken"/>
                </div>
                <h3>Chicken</h3>
                <p>Extra super crispy fried chicken thigh, honey sriracha glaze, coleslaw.</p>
                <div class="menu-footer">
                    <span class="price">₱179</span>
                    <button class="btn-add">Add +</button>
                </div>
            </div>

            <div class="menu-card reveal">
                <div class="menu-img-wrap">
                    <img src="assets/pizza.png" alt="Pizza"/>
                </div>
                <h3>Pizza</h3>
                <p>Thin crust pizza with rich tomato sauce, melted mozzarella, and fresh basil.</p>
                <div class="menu-footer">
                    <span class="price">₱159</span>
                    <button class="btn-add">Add +</button>
                </div>
            </div>

            <div class="menu-card reveal">
                <div class="menu-img-wrap">
                    <img src="assets/fries.png" alt="Fries"/>
                </div>
                <h3>Fries</h3>
                <p>XL seasoned fries topped with cheese sauce and crispy bacon bits.</p>
                <div class="menu-footer">
                    <span class="price">₱99</span>
                    <button class="btn-add">Add +</button>
                </div>
            </div>

        </div>
    </section>

    <!-- ══════════════════════════════════════
        ABOUT
    ══════════════════════════════════════ -->
    <section id="about" class="section about-section">
        <div class="about-logo reveal">
            <img src="assets/mcdolibee_logo.png" alt="McDollibee Logo"/>
        </div>
        <div class="about-text reveal">
            <span class="section-tag">About Us</span>
            <h2 class="section-title">Boldly <span class="text-yellow stroke-red">Delicious</span> Since 2026</h2>
            <p class="about-desc">
                McDollibee was born from a single food cart, a big dream, and a secret seasoning recipe.
                Today we serve thousands of happy customers daily but the passion hasn't changed one bit.
            </p>
            <ul class="about-list">
                <li><i class="fa-solid fa-check check-icon"></i> 100% fresh, never frozen patties</li>
                <li><i class="fa-solid fa-check check-icon"></i> Locally sourced produce &amp; chicken</li>
                <li><i class="fa-solid fa-check check-icon"></i> Zero artificial preservatives</li>
            </ul>
        </div>
    </section>

    <!-- ══════════════════════════════════════
        CONTACT
    ══════════════════════════════════════ -->
    <section id="contact" class="section contact-section">
        <div class="section-header">
            <span class="section-tag">Contact Us</span>
            <h2 class="section-title">We'd Love to <span class="text-yellow stroke-red">Hear</span> From You</h2>
        </div>
        <div class="contact-grid">
            <div class="contact-card reveal">
                <i class="fa-solid fa-location-dot contact-icon"></i>
                <h4>Location</h4>
                <p>123 Burger Lane, Quezon City, PH</p>
            </div>
            <div class="contact-card reveal">
                <i class="fa-solid fa-phone contact-icon"></i>
                <h4>Phone</h4>
                <p>+63 912 345 6789</p>
            </div>
            <div class="contact-card reveal">
                <i class="fa-solid fa-envelope contact-icon"></i>
                <h4>Email</h4>
                <p>hello@mcdollibee.ph</p>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════════════
        FOOTER
    ══════════════════════════════════════ -->
    <footer class="footer">
        <div class="footer-brand">
            <img src="assets/mcdolibee_logo.png" alt="McDollibee Logo" class="footer-logo"/>
            <span class="brand-text">Mc<span class="brand-yellow">Dollibee</span></span>
        </div>
        <p class="footer-copy">© 2026 McDollibee. All rights reserved.</p>
        <div class="footer-socials">
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-tiktok"></i></a>
        </div>
    </footer>

    <!-- ══════════════════════════════════════
        MODAL
    ══════════════════════════════════════ -->
    <div id="modalOverlay" class="modal-overlay">
        <div id="modalBox" class="modal-box">

            <button id="modalClose" class="modal-close">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <!-- ── LOGIN PANEL ── -->
            <div id="loginPanel" <?= $panel === 'register' ? 'class="hidden"' : '' ?>>
                <div class="modal-brand">
                    <img src="assets/mcdolibee_logo.png" alt="logo" class="modal-logo"/>
                    <span class="brand-text">Mc<span class="brand-yellow">Dollibee</span></span>
                </div>
                <h2 class="modal-title">Welcome Back!</h2>
                <p class="modal-sub">Log in to continue your cravings</p>

                <?php if ($error && $panel === 'login'): ?>
                    <div class="error-box">
                        <i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="process.php">
                    <input type="hidden" name="action" value="login">
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-user input-icon"></i>
                            <input type="text" name="username" placeholder="Enter username"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" name="password" placeholder="Enter password"/>
                            <i class="fa-solid fa-eye toggle-pass"></i>
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="checkbox-label">
                            <input type="checkbox" name="remember"/> Remember me
                        </label>
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn-submit">
                        Login <i class="fa-solid fa-right-to-bracket"></i>
                    </button>
                </form>
                <p class="modal-switch">
                    Don't have an account? <span id="goRegister">Register here</span>
                </p>
            </div>

            <!-- ── REGISTER PANEL ── -->
            <div id="registerPanel" <?= $panel !== 'register' ? 'class="hidden"' : '' ?>>
                <div class="modal-brand">
                    <img src="assets/mcdolibee_logo.png" alt="logo" class="modal-logo"/>
                    <span class="brand-text">Mc<span class="brand-yellow">Dollibee</span></span>
                </div>
                <h2 class="modal-title">Create Account</h2>
                <p class="modal-sub">Join the McDollibee family today!</p>

                <?php if ($error && $panel === 'register'): ?>
                    <div class="error-box">
                        <i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="process.php">
                    <input type="hidden" name="action" value="register">
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-user input-icon"></i>
                            <input type="text" name="username" placeholder="Choose a username"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-envelope input-icon"></i>
                            <input type="email" name="email" placeholder="Enter email"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-phone input-icon"></i>
                            <input type="tel" name="phone" placeholder="+63 9XX XXX XXXX"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" name="password" placeholder="Create password"/>
                            <i class="fa-solid fa-eye toggle-pass"></i>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" name="confirm_password" placeholder="Confirm password"/>
                            <i class="fa-solid fa-eye toggle-pass"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">
                        Create Account <i class="fa-solid fa-user-plus"></i>
                    </button>
                </form>
                <p class="modal-switch">
                    Already have an account? <span id="goLogin">Login here</span>
                </p>
            </div>

        </div>
    </div>

    <script src="assets/js/script.js"></script>

    <?php if ($error): ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const overlay = document.getElementById('modalOverlay');
            const box     = document.getElementById('modalBox');
            if (overlay) { overlay.style.opacity = '1'; overlay.style.pointerEvents = 'auto'; }
            if (box)     { box.style.transform = 'scale(1) translateY(0)'; }
        });
    </script>
    <?php endif; ?>
</body>
</html>
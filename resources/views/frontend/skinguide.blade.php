<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skin Guide - Dermascan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS Variables */
        :root {
            --primary-color: #08afb4;    /* Vibrant teal */
            --secondary-color: #08afb4;  /* Coral accent */
            --text-color: #2d3748;      /* Dark slate */
            --heading-color: #1a202c;   /* Near black */
            --background-color: #ffffff; /* Light background */
            --footer-bg: #2d3748;       /* Dark slate footer */
            --footer-text: #edf2f7;     /* Light footer text */
            --card-bg: #ffffff;         /* White for cards */
            --gradient-start: #e6fffa;  /* Light teal gradient */
        }

        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background-color);
        }

        /* Header */
        header {
            background-color: var(--background-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            color: var(--primary-color);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 25px;
            margin: 0;
            padding: 0;
        }

        nav a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 600;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: var(--secondary-color);
        }

        .button {
            border: 2px solid var(--primary-color);
            padding: 8px 15px;
            border-radius: 5px;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .button:hover {
            background-color: var(--primary-color);
            color: white;
        }
        .button2{
    border: 2px solid white;
    padding: 8px 15px;
    border-radius: 5px;
    color: black;
    transition: all 0.3s ease;
}

        /* Hero Section */
        .hero {
            background-image: linear-gradient(to bottom, var(--gradient-start), var(--background-color));
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--heading-color);
        }

        .hero-content {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 20px;
        }

        /* Main Content */
        .skin-guide {
            padding: 40px 20px;
            max-width: 900px;
            margin: 0 auto;
        }

        .skin-guide h2 {
            color: var(--heading-color);
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            margin-top: 40px;
            margin-bottom: 15px;
        }

        .skin-guide p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* Collapsible Tips */
        .tips {
            margin-bottom: 40px;
        }

        .tip {
            background-color: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .tip-header {
            padding: 15px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--heading-color);
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .tip-header:hover {
            background-color: var(--gradient-start);
        }

        .tip-header i {
            color: var(--primary-color);
            transition: transform 0.3s ease;
        }

        .tip-header.active i {
            transform: rotate(180deg);
        }

        .tip-content {
            padding: 0 15px 15px;
            display: none;
            font-size: 14px;
        }

        .tip-content.active {
            display: block;
        }

        /* Skin Conditions */
        .conditions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .condition-card {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .condition-card:hover {
            transform: scale(1.05);
        }

        .condition-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .condition-card h3 {
            font-size: 18px;
            color: var(--heading-color);
            margin-bottom: 10px;
        }

        .condition-card p {
            font-size: 14px;
        }

        /* CTA */
        .cta {
            text-align: center;
            margin-top: 40px;
        }

        .cta .button {
            display: inline-block;
            padding: 15px 30px;
            font-size: 18px;
            background: linear-gradient(45deg, var(--primary-color), #0a969a);
            color: white;
            border: none;
            border-radius: 25px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
        }

        .cta .button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            background: var(--primary-color);
        }

        /* Footer */
        footer {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            padding: 40px 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }

        .footer-links {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
        }

        .column {
            min-width: 200px;
        }

        .column h3 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .column ul {
            list-style: none;
            padding: 0;
        }

        .column a {
            color: var(--footer-text);
            text-decoration: none;
            font-size: 14px;
            display: block;
            margin: 5px 0;
            transition: color 0.3s ease;
        }

        .column a:hover {
            color: var(--secondary-color);
        }

        .footer-info {
            text-align: center;
            width: 100%;
            margin-top: 20px;
        }

        .footer-info p {
            margin: 5px 0;
            font-size: 14px;
        }

        .footer-info a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-info a:hover {
            color: var(--secondary-color);
        }

        .social-media {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .social-media a {
            color: var(--footer-text);
            font-size: 26px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-media a:hover {
            color: var(--secondary-color);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .skin-guide {
                padding: 20px;
            }
            
            .skin-guide h2 {
                font-size: 24px;
            }
            
            .conditions {
                grid-template-columns: 1fr;
            }
        }

    </style>
</head>
<body>
   <header>
        <a href="{{url('/')}}" style="text-decoration: none;">
            <div class="logo">DERMASCAN</div>
        </a>
        <nav>
            <ul>
                <li><a href="{{route('getcheck')}}">Get checked</a></li>
                <li><a href="{{route('aboutus')}}">About us</a></li>
                <li><a href="{{route('skinguide')}}">Skin Guide</a></li>
                <li><a href="{{route('research')}}">Research</a></li>
                <li><a href="{{route('contactus')}}">contact us</a></li>
                <li><a href="{{route('pharmacy')}}"><i class="fas fa-capsules" style="margin-right: 7px;"></i>Pharmacy</a></li>
                <li>
                    <a href="javascript:void(0);" id="cart-icon" class="button2" style="position:relative;">
                        <i class="fas fa-shopping-cart"></i>
                        <span id="cart-count" style="position:absolute;top:-8px;right:-8px;background:#08afb4;color:#fff;border-radius:50%;padding:2px 7px;font-size:12px;display:none;">0</span>
                    </a>
                </li>
                <li><a href="{{route('login')}}" class="button2"><i class="fas fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    
    <!-- Cart Sidebar -->
    <div id="cart-sidebar" style="position:fixed;top:0;right:-400px;width:350px;height:100vh;background:#fff;box-shadow:-2px 0 10px rgba(0,0,0,0.15);z-index:9999;transition:right 0.3s;padding:30px 20px 20px 20px;overflow-y:auto;">
        <div style="display:flex;justify-content:space-between;align-items:center;">
            <h3 style="margin:0;font-size:22px;">Your Cart</h3>
            <button id="close-cart" style="background:none;border:none;font-size:22px;cursor:pointer;">&times;</button>
        </div>
        <div id="cart-items" style="margin-top:20px;"></div>
        <div id="cart-footer" style="margin-top:20px;display:none;">
            <hr>
            <div style="display:flex;justify-content:space-between;font-weight:bold;">
                <span>Total:</span>
                <span id="cart-total"></span>
            </div>
            <a href="{{ route('checkoutpharmacy') }}" class="button" style="width:85%;margin-top:15px;display:block;text-align:center;">Checkout</a>
        </div>
        <div id="cart-empty" style="margin-top:30px;text-align:center;color:#888;display:none;">
            <i class="fas fa-shopping-basket" style="font-size:40px;margin-bottom:10px;"></i>
            <div>Your cart is empty.</div>
        </div>
    </div>
    <script>
        // Show cart count if items exist
        function updateCartCount() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let count = cart.reduce((sum, item) => sum + item.qty, 0);
            let cartCount = document.getElementById('cart-count');
            if (count > 0) {
                cartCount.style.display = 'inline-block';
                cartCount.textContent = count;
            } else {
                cartCount.style.display = 'none';
            }
        }

        // Populate cart sidebar
        function populateCartSidebar() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let cartItems = document.getElementById('cart-items');
            let cartFooter = document.getElementById('cart-footer');
            let cartEmpty = document.getElementById('cart-empty');
            let cartTotal = document.getElementById('cart-total');
            cartItems.innerHTML = '';
            if (cart.length === 0) {
                cartFooter.style.display = 'none';
                cartEmpty.style.display = 'block';
                return;
            }
            cartFooter.style.display = 'block';
            cartEmpty.style.display = 'none';
            let total = 0;
            cart.forEach((item, idx) => {
                let itemTotal = parseFloat(item.price) * item.qty;
                total += itemTotal;
                cartItems.innerHTML += `
                    <div style="display:flex;align-items:center;margin-bottom:18px;" data-idx="${idx}">
                        <img src="${item.image}" alt="${item.name}" style="width:55px;height:55px;border-radius:8px;object-fit:cover;margin-right:12px;">
                        <div style="flex:1;">
                            <div style="font-weight:600;">${item.name}</div>
                            <div style="font-size:13px;color:#666;">
                                <button class="qty-btn" data-action="decrement" data-idx="${idx}" style="border:none;background:#eee;padding:2px 8px;border-radius:3px;font-size:16px;cursor:pointer;">-</button>
                                <span style="margin:0 7px;" id="qty-${idx}">${item.qty}</span>
                                <button class="qty-btn" data-action="increment" data-idx="${idx}" style="border:none;background:#eee;padding:2px 8px;border-radius:3px;font-size:16px;cursor:pointer;">+</button>
                                × Rs.${item.price}
                            </div>
                        </div>
                        <div style="font-weight:bold;margin-right:10px;">Rs.${itemTotal.toFixed(2)}</div>
                        <button class="delete-cart-item" data-idx="${idx}" style="background:none;border:none;color:#d00;font-size:18px;cursor:pointer;" title="Remove">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;
            });
            cartTotal.textContent = 'Rs.' + total.toFixed(2);

            // Add event listeners for quantity buttons and delete
            document.querySelectorAll('.qty-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    let idx = parseInt(this.getAttribute('data-idx'));
                    let action = this.getAttribute('data-action');
                    updateCartItemQty(idx, action);
                });
            });
            document.querySelectorAll('.delete-cart-item').forEach(btn => {
                btn.addEventListener('click', function() {
                    let idx = parseInt(this.getAttribute('data-idx'));
                    removeCartItem(idx);
                });
            });
        }

        // Update quantity in cart
        function updateCartItemQty(idx, action) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            if (cart[idx]) {
                if (action === 'increment') {
                    cart[idx].qty += 1;
                } else if (action === 'decrement') {
                    cart[idx].qty -= 1;
                    if (cart[idx].qty < 1) cart[idx].qty = 1;
                }
                localStorage.setItem('cart', JSON.stringify(cart));
                populateCartSidebar();
                updateCartCount();
            }
        }

        // Remove item from cart
        function removeCartItem(idx) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(idx, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            populateCartSidebar();
            updateCartCount();
        }

        // Open/close sidebar
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            // Show sidebar on cart icon click
            document.getElementById('cart-icon').addEventListener('click', function() {
                populateCartSidebar();
                document.getElementById('cart-sidebar').style.right = '0';
            });
            // Close sidebar
            document.getElementById('close-cart').addEventListener('click', function() {
                document.getElementById('cart-sidebar').style.right = '-400px';
            });
            // Update cart count on storage change (for multi-tab)
            window.addEventListener('storage', function(e) {
                if (e.key === 'cart') updateCartCount();
            });
        });

        // Also update cart count after addToCart is called
        function updateCartAfterAdd() {
            updateCartCount();
        }
        // If you use addToCart elsewhere, call updateCartAfterAdd() after localStorage.setItem
    </script>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Skin Guide</h1>
            <p>Your Resource for Healthy Skin</p>
        </div>
    </section>

    <!-- Main Content -->
    <main>
        <section class="skin-guide">
            <h2>Welcome to Your Skin Guide</h2>
            <p>At Dermascan, we’re committed to empowering you with knowledge about skin health. This guide provides expert tips, information on common skin conditions, and steps to maintain a radiant complexion—all backed by our team of certified dermatologists.</p>

            <h2>Essential Skin Care Tips</h2>
            <div class="tips">
                <div class="tip">
                    <div class="tip-header">
                        <span>Daily Skin Care Routine</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="tip-content">
                        <p>Cleanse your face twice daily with a gentle cleanser, apply a moisturizer suited to your skin type, and use sunscreen with at least SPF 30 every morning to protect against UV damage.</p>
                    </div>
                </div>
                <div class="tip">
                    <div class="tip-header">
                        <span>Hydration and Diet</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="tip-content">
                        <p>Drink plenty of water and eat a balanced diet rich in antioxidants (like berries and leafy greens) to support skin repair and elasticity.</p>
                    </div>
                </div>
                <div class="tip">
                    <div class="tip-header">
                        <span>When to See a Dermatologist</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="tip-content">
                        <p>Consult a professional if you notice persistent redness, unusual moles, or any changes in your skin that last more than two weeks.</p>
                    </div>
                </div>
            </div>

            <h2>Common Skin Conditions</h2>
            <div class="conditions">
                <div class="condition-card">
                    <img src="https://www.acneaction.ca/wp-content/uploads/2023/06/image-45.png" alt="Acne example">
                    <h3>Acne</h3>
                    <p>A common condition caused by clogged pores, often treatable with topical solutions or professional care.</p>
                </div>
                <div class="condition-card">
                    <img src="https://www.the-cma.org.uk/wp-content/uploads/eczema-1024x536.png" alt="Eczema example">
                    <h3>Eczema</h3>
                    <p>Characterized by itchy, inflamed skin; managed with moisturizers and sometimes prescription treatments.</p>
                </div>
                <div class="condition-card">
                    <img src="https://www.manusood.com/uploads/gallery/cropped_e64408e99ff19bfa7f99c650727b9ac647fec9d9.jpg" alt="Melanoma example">
                    <h3>Melanoma</h3>
                    <p>A serious form of skin cancer; early detection is key—watch for asymmetrical moles or color changes.</p>
                </div>
            </div>

            <h2>Take Control of Your Skin Health</h2>
            <p>Use this guide as a starting point, but for personalized advice, our experts are just a click away. Upload your skin concerns and get a professional analysis today.</p>

            <div class="cta">
                <a href="{{route('getcheck')}}" class="button">Get Checked Now</a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <div class="column">
                <h3>The Company</h3>
                <ul>
                    <li><a href="#">Send a Case</a></li>
                    <li><a href="#">Review Your Case</a></li>
                    <li><a href="#">The Team</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Get Involved</h3>
                <ul>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Partnerships</a></li>
                    <li><a href="#">Spot Cancer</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Resources</h3>
                <ul>
                    <li><a href="#">Skin Image Search</a></li>
                    <li><a href="#">Partner Program</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-info">
            <p>DermaScan Ai</p>
            <p></p>
            <p>
                <a href="#">Terms & Conditions</a> - 
                <a href="#">Website Terms of Use</a>
            </p>
            <p>
                <a href="#">Privacy Notice</a> - 
                <a href="#">Privacy Shield</a> - 
                <a href="#">Terms & Conditions Autoderm</a>
            </p>
        </div>
        <div class="social-media">
            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/twitter?lang=en" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

    <!-- JavaScript for Collapsible Tips -->
    <script>
        document.querySelectorAll('.tip-header').forEach(header => {
            header.addEventListener('click', () => {
                const content = header.nextElementSibling;
                const icon = header.querySelector('i');
                content.classList.toggle('active');
                header.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
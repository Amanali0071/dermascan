<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - DermaScan</title>
    <link rel="stylesheet" href="{{asset('frontend/css/contactus.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    <!-- Main Content -->
    <main>
        <section class="contact-intro">
            <h1>Contact Us</h1>
            <p>We’re here to assist you with any questions or concerns. Reach out to us via the form below, email, or phone.</p>
        </section>

        <section class="contact-details">
            <!-- Contact Information -->
            <div class="contact-info">
                <h2>Get in Touch</h2>
                <ul>
                    <li><i class="fas fa-envelope"></i> <a href="mailto:muzamiliqbal2001@gmail.com">muzamiliqbal2001@gmail.com</a></li>
                    <li><i class="fas fa-phone"></i> <a href="tel:+92371631928">+92 371 631928</a></li>
                    <li><i class="fas fa-map-marker-alt"></i> Taxila, Pakistan</li>
                </ul>
            </div>
            <!-- Contact Form -->
            <div class="contact-form">
                <h2>Send Us a Message</h2>
                <div class="form-wrapper"> <!-- Added wrapper -->
                    <form id="contactForm" action="{{route('contactus.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="button">Send Message</button>
                    </form>
                    <p id="formMessage" class="form-message"></p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
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
            <p><a href="#">Terms & Conditions</a> - <a href="#">Website Terms of Use</a></p>
            <p><a href="#">Privacy Notice</a> - <a href="#">Privacy Shield</a> - <a href="#">Terms & Conditions Autoderm</a></p>
        </div>
        <div class="social-media">
            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/twitter?lang=en" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

    <script src="{{asset('frontend/js/contact-us.js')}}"></script>
</body>
</html>
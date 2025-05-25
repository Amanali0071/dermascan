<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy - Skin Care Products</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: #2d3748;
            line-height: 1.6;
        }

        header {
            background-color: #ffffff;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 10;
            position: sticky;
            top: 0;
        }

        .logo {
    font-family: 'Playfair Display', serif;
    font-size: 36px;
    color:#08afb4;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}
        nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        nav a {
            text-decoration: none;
            color: #2d3748;
            font-weight: 600;
        }

     

        nav a:hover {
            color: #08afb4;
        }

       
    .button {
    border: 2px solid #08afb4;
    padding: 8px 15px;
    border-radius: 5px;
    color: #08afb4;
    transition: all 0.3s ease;
    background: white;
}

.button:hover {
    background-color: #08afb4;
    color: white;
}

        main {
            padding: 40px;
            background: white;
        }

        .pharmacy {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .pharmacy h1 {
            font-size: 32px;
            margin-bottom: 40px;
            color: #067d81;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            border: 1px solid darkgray;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
        }

        .product-card img {
            width: 60%;
            height: 200px;
            object-fit: cover;
        }

        .product-card h2 {
            font-size: 18px;
            margin: 15px 0 10px;
            padding: 0 15px;
        }

        .product-card p {
            font-size: 14px;
            color: #4a5568;
            padding: 0 15px;
            margin-bottom: 15px;
        }

        .product-card .price {
            font-size: 16px;
            font-weight: bold;
            color: #08afb4;
            padding: 0 15px 15px;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .modal.show {
            opacity: 1;
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 500px;
            padding: 20px;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #ccc;
        }

        footer {
            background-color: #2d3748;
            color: #edf2f7;
            padding: 40px 20px;
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-bottom: 20px;
         
        }
      

        .column h3 {
            font-size: 18px;
            color: #08afb4;
        }

        .column ul {
            list-style: none;
            padding: 0;
        }

        .column a {
            color: #edf2f7;
            text-decoration: none;
        }

        .social-media a {
            color: #edf2f7;
            margin: 0 10px;
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: 1fr;
            }

            .footer-links {
                flex-direction: column;
                gap: 20px;
            }

            header {
                flex-direction: column;
                padding: 20px;
                align-items: center;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
                gap: 10px;
                margin-top: 20px;
            }

            nav a {
                width: 100%;
                text-align: center;
            }

            nav a.button {
                width: auto;
            }
        }
    </style>
</head>
<body>
    <!-- Modal Structure -->
    <div id="imageModal" class="modal">
        <span class="close">×</span>
        <img class="modal-content" id="modalImage">
    </div>

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
        <section class="pharmacy">
            <h1>Pharmacy Products</h1>
            <div class="product-grid">

                @foreach ($medicines as $medicine)
                <div class="product-card pb-2" onclick="openModal('{{ $medicine->image }}')">
                    <img src="{{ $medicine->image }}" alt="{{ $medicine->name }}">
                    <h2>{{ $medicine->name }}</h2>
                    <p>{{ str($medicine->description)->limit(150) }}</p>
                    <p class="price">Rs. {{ $medicine->price }}</p>
                    <button class="button add-to-cart-btn"
                        data-id="{{ $medicine->id }}"
                        data-name="{{ $medicine->name }}"
                        data-price="{{ $medicine->price }}"
                        data-image="{{ $medicine->image }}"
                        onclick="event.stopPropagation(); addToCart(this);"
                    >
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                    <br>
                </div>
                @endforeach

                <script>
                function addToCart(btn) {
                    const id = btn.getAttribute('data-id');
                    const name = btn.getAttribute('data-name');
                    const price = btn.getAttribute('data-price');
                    const image = btn.getAttribute('data-image');
                    let cart = JSON.parse(localStorage.getItem('cart')) || [];
                    const existing = cart.find(item => item.id == id);
                    if (existing) {
                        existing.qty += 1;
                    } else {
                        cart.push({ id, name, price, image, qty: 1 });
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));
                    btn.innerHTML = '<i class="fas fa-check"></i> Added';
                    setTimeout(() => {
                        btn.innerHTML = '<i class="fas fa-cart-plus"></i> Add to Cart';
                    }, 1000);
                }
                </script>

                <!-- Product 1 -->
                <div class="product-card" onclick="openModal('https://img.nivea.com/-/media/miscellaneous/media-center-items/c/2/3/287207-web_1010x1180_transparent_png.webp?mw=640&hash=1F8F639D5CBD34C79E6B8D39B2CE986F')">
                    <img src="https://img.nivea.com/-/media/miscellaneous/media-center-items/c/2/3/287207-web_1010x1180_transparent_png.webp?mw=640&hash=1F8F639D5CBD34C79E6B8D39B2CE986F" alt="Hydrating Lotion">
                    <h2>Hydrating Lotion</h2>
                    <p>A lightweight, fast-absorbing lotion that provides long-lasting hydration. Ideal for normal to dry skin.</p>
                    <p class="price">Rs. 1500</p>
                </div>
                {{-- <!-- Product 2 -->
                <div class="product-card" onclick="openModal('https://bioaqua.com.pk/cdn/shop/files/Hd061a4372add4b27b4ceb1aeadeea994N_800x.webp?v=1727369808')">
                    <img src="https://bioaqua.com.pk/cdn/shop/files/Hd061a4372add4b27b4ceb1aeadeea994N_800x.webp?v=1727369808" alt="Acne Treatment Cream">
                    <h2>Acne Treatment Cream</h2>
                    <p>Formulated with salicylic acid to reduce acne and prevent future breakouts.</p>
                    <p class="price">Rs. 1200</p>
                </div>
                <!-- Product 3 -->
                <div class="product-card" onclick="openModal('https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/scm/scm92604/g/9.jpg')">
                    <img src="https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/scm/scm92604/g/9.jpg" alt="Anti-Aging Serum">
                    <h2>Anti-Aging Serum</h2>
                    <p>Contains retinol and hyaluronic acid to reduce fine lines and improve skin texture.</p>
                    <p class="price">Rs. 2500</p>
                </div>
                <!-- Product 4 -->
                <div class="product-card" onclick="openModal('https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/euc/euc03225/g/12.jpg')">
                    <img src="https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/euc/euc03225/g/12.jpg" alt="Sunscreen SPF 50">
                    <h2>Sunscreen SPF 50</h2>
                    <p>Broad-spectrum protection against UVA and UVB rays. Water-resistant and non-greasy.</p>
                    <p class="price">Rs. 1800</p>
                </div>
                <!-- Product 5 -->
                <div class="product-card" onclick="openModal('https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/euc/euc02553/g/10.jpg')">
                    <img src="https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/euc/euc02553/g/10.jpg" alt="Eczema Relief Cream">
                    <h2>Eczema Relief Cream</h2>
                    <p>Soothing cream with colloidal oatmeal to relieve itching and irritation from eczema.</p>
                    <p class="price">Rs. 1400</p>
                </div>
                <!-- Product 6 -->
                <div class="product-card" onclick="openModal('https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/ide/ide02368/g/9.jpg')">
                    <img src="https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/ide/ide02368/g/9.jpg" alt="Vitamin C Serum">
                    <h2>Vitamin C Serum</h2>
                    <p>Brightens skin and reduces dark spots with a potent dose of vitamin C.</p>
                    <p class="price">Rs. 2200</p>
                </div>

                <!-- Product 5 -->
<div class="product-card" onclick="openModal('https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/roc/roc21427/l/24.jpg')">
    <img src="https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/roc/roc21427/l/24.jpg" alt="Hydrating Moisturizer">
    <h2>Hydrating Moisturizer</h2>
    <p>Deeply nourishes and hydrates the skin, leaving it soft and supple. Suitable for all skin types.</p>
    <p class="price">Rs. 1500</p>
</div>

<!-- Product 6 -->
<div class="product-card" onclick="openModal('https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/vnc/vnc32208/g/12.jpg')">
    <img src="https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/vnc/vnc32208/g/12.jpg" alt="Gentle Cleanser">
    <h2>Gentle Cleanser</h2>
    <p>Removes impurities without stripping the skin's natural oils. Ideal for sensitive skin.</p>
    <p class="price">Rs. 1200</p>
</div>

<!-- Product 7 -->
<div class="product-card" onclick="openModal('https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/lex/lex21291/g/55.jpg')">
    <img src="https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/lex/lex21291/g/55.jpg" alt="Anti-Aging Serum">
    <h2>Anti-Aging Serum</h2>
    <p>Reduces the appearance of fine lines and wrinkles, promoting a youthful glow.</p>
    <p class="price">Rs. 2500</p>
</div>

<!-- Product 8 -->
<div class="product-card" onclick="openModal('https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/hrp/hrp31795/g/8.jpg')">
    <img src="https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/hrp/hrp31795/g/8.jpg" alt="Detoxifying Face Mask">
    <h2>Detoxifying Face Mask</h2>
    <p>Draws out impurities and toxins, leaving the skin refreshed and revitalized.</p>
    <p class="price">Rs. 1800</p>
</div>

<!-- Product 9 -->
<div class="product-card" onclick="openModal('https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/smi/smi39001/g/10.jpg')">
    <img src="https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/smi/smi39001/g/10.jpg" alt="Acne Spot Treatment">
    <h2>Acne Spot Treatment</h2>
    <p>Targets and reduces acne blemishes quickly, with soothing ingredients to calm the skin.</p>
    <p class="price">Rs. 1000</p>
</div>

<!-- Product 10 -->
<div class="product-card" onclick="openModal('https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/swv/swv11674/g/8.jpg')">
    <img src="https://cloudinary.images-iherb.com/image/upload/f_auto,q_auto:eco/images/swv/swv11674/g/8.jpg" alt="Revitalizing Eye Cream">
    <h2>Revitalizing Eye Cream</h2>
    <p>Reduces dark circles and puffiness, hydrating the delicate skin around the eyes.</p>
    <p class="price">Rs. 2000</p>
</div> --}}
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
                <a href="#" style="color: aliceblue;">Terms & Conditions</a> - 
                <a href="#" style="color: aliceblue;">Website Terms of Use</a>
            </p>
            <p>
                <a href="#" style="color: aliceblue;">Privacy Notice</a> - 
                <a href="#" style="color: aliceblue;">Privacy Shield</a> - 
                <a href="#" style="color: aliceblue;">Terms & Conditions Autoderm</a>
            </p>
        </div>
        <div class="social-media">
            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/twitter?lang=en" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="{{asset('frontend/js/pharmacy.js')}}"></script>
</body>
</html>
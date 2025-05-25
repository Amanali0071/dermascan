<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research - DermaScan</title>
    <link rel="stylesheet" href="{{asset('frontend/css/research.css')}}">
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
        <!-- Intro Section -->
        <section class="intro">
            <h1>Research at DermaScan</h1>
            <p>Discover groundbreaking advancements in dermatology through our comprehensive research hub. At DermaScan, we are dedicated to pushing the boundaries of skin health science, offering insights into the latest studies, our own pioneering contributions, and a wealth of educational resources for professionals and patients alike.</p>
        </section>

        <!-- Latest Studies Section -->
        <section class="latest-studies">
            <h2>Latest Studies</h2>
            <div class="studies-grid">
                <div class="study-card">
                    <h3>Advancements in Teledermatology</h3>
                    <p>This 2023 study examines how teledermatology enhances patient access to care, reducing diagnostic delays by 40% in underserved regions. Published in the *Journal of Dermatological Science*.</p>
                    <a href="https://example.com/teledermatology" target="_blank">Read Full Study</a>
                </div>
                <div class="study-card">
                    <h3>AI-Powered Dermatology Diagnostics</h3>
                    <p>A peer-reviewed paper exploring AI algorithms achieving 95% accuracy in identifying melanoma, with implications for scalable screening solutions.</p>
                    <a href="https://example.com/ai-dermatology" target="_blank">Read Full Study</a>
                </div>
                <div class="study-card">
                    <h3>Non-Invasive Skin Cancer Detection</h3>
                    <p>An in-depth analysis of optical coherence tomography (OCT) for early skin cancer detection, reducing biopsy rates by 30%. Published in *Nature Dermatology*.</p>
                    <a href="https://example.com/skin-cancer-detection" target="_blank">Read Full Study</a>
                </div>
            </div>
        </section>

        <!-- Our Contributions Section -->
        <section class="our-contributions">
            <h2>Our Contributions</h2>
            <p>DermaScan is at the forefront of dermatological innovation, collaborating with global experts to advance skin health solutions. Our research efforts focus on improving diagnostic accuracy, patient outcomes, and accessibility. Key initiatives include:</p>
            <ul>
                <li><strong>Melanoma Detection AI:</strong> Developed a proprietary machine learning model, trained on over 50,000 dermoscopic images, achieving a sensitivity of 97%.</li>
                <li><strong>Environmental Impact Studies:</strong> Partnered with UC Berkeley to investigate how pollution and UV radiation exacerbate eczema and psoriasis, with findings presented at the 2023 Dermatology Summit.</li>
                <li><strong>Teledermatology Outreach:</strong> Conducted a 2-year study across rural clinics, published in *The Lancet*, demonstrating a 25% increase in early diagnosis rates.</li>
            </ul>
            <a href="#" class="cta-button">Learn More About Our Work</a>
        </section>

        <!-- Educational Resources Section -->
        <section class="educational-resources">
            <h2>Educational Resources</h2>
            <p>Empower yourself with knowledge from our curated collection of dermatology resources, designed for both patients and healthcare professionals.</p>
            <div class="resources-list">
                <div class="resource-item">
                    <i class="fas fa-book"></i>
                    <div>
                        <a href="https://example.com/acne-guide" target="_blank">Understanding Acne: Causes and Treatments</a>
                        <p>A detailed guide covering hormonal, dietary, and environmental triggers, plus evidence-based treatment options.</p>
                    </div>
                </div>
                <div class="resource-item">
                    <i class="fas fa-video"></i>
                    <div>
                        <a href="https://example.com/skin-aging-video" target="_blank">Video: The Science of Skin Aging</a>
                        <p>A 15-minute explainer on collagen degradation and anti-aging interventions, featuring Dr. Jane Smith.</p>
                    </div>
                </div>
                <div class="resource-item">
                    <i class="fas fa-file-alt"></i>
                    <div>
                        <a href="https://example.com/skin-conditions-infographic" target="_blank">Infographic: Common Skin Conditions</a>
                        <p>A visual breakdown of symptoms and prevalence for acne, eczema, and psoriasis.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Search Section -->
        <section class="search-section">
            <h2>Search Research Topics</h2>
            <p>Find specific studies and resources by entering keywords below.</p>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="e.g., melanoma, teledermatology, AI">
                <button id="searchButton">Search</button>
            </div>
            <div id="searchResults" class="search-results"></div>
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

    <script src="{{asset('frontend/js/research.js')}}"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Plan Checkout - Dermascan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #08afb4;    /* Vibrant teal */
            --secondary-color: #08afb4;  /* Coral accent */
            --text-color: #575a5f;      /* Dark slate */
            --heading-color: #1a202c;   /* Near black */
            --background-color: white; /* Light teal background */
            --card-bg: #ffffff;         /* White for cards */
            --button-bg: #08afb4;       /* Button background */
            --success-color: #2ecc71;   /* Green for success */
            --tab-bg: #e5ecef;         /* Light gray for tabs */
            --border-color: #676768;   /* Subtle gray for borders */
            --footer-bg: #2d3748;       /* Dark slate footer */
            --footer-text: #edf2f7;     /* Light footer text */
            --gradient-start: #e6fffa;  /* Light teal gradient */
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
            font-size: 16px;
        }

        /* Header */
        header {
            background-color: var(--card-bg);
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

        /* Main Content */
        .checkout-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            display: flex;
            flex-direction: row;
            gap: 40px;
            justify-content: center;
            align-items: stretch;
        }

        .plan-summary, .payment-form {
            background-color: var(--card-bg);
            border-radius: 8px;
            padding: 30px;
            border: 1px solid var(--border-color);
            width: 100%;
            max-width: 500px;
            flex: 1;
        }

        .plan-summary h2, .payment-form h2 {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            color: var(--heading-color);
            margin: 0 0 20px;
            font-weight: 700;
        }

        .plan-summary p {
            font-size: 15px;
            margin: 10px 0;
            color: #4b5563;
        }

        .plan-summary .price {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-color);
            margin: 15px 0;
        }

        .plan-summary .features {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .plan-summary .features li {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 12px 0;
            font-size: 14px;
        }

        .plan-summary .features i {
            color: var(--primary-color);
            font-size: 16px;
        }

        /* Payment Tabs */
        .payment-tabs {
            display: flex;
            border-radius: 8px;
            padding: 4px;
            margin-bottom: 25px;
            border: 1px solid var(--border-color);
        }

        .payment-tabs button {
            flex: 1;
            padding: 12px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            background: none;
            color: var(--text-color);
            cursor: pointer;
            transition: background 0.3s ease, color 0.3s ease;
            border-radius: 6px;
        }

        .payment-tabs button.active {
            background: var(--primary-color);
            color: white;
        }

        .payment-tabs button:hover:not(.active) {
            color: var(--primary-color);
            background: rgb(230, 230, 230);
        }

        /* Payment Forms */
        .payment-form{
            background-color: var(--card-bg);
    border-radius: 8px;
    padding: 30px;
    border: 1px solid var(--border-color);
    width: 100%;
    max-width: 500px;
    flex: 1;
    min-height: 550px; /* Added to fix footer movement */
        }
        .payment-content {
            display: none;
            flex-direction: column;
            gap: 20px;
        }

        .payment-content.active {
            display: flex;
        }

        .payment-content label {
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 6px;
            color: var(--heading-color);
        }

        .payment-content input, .payment-content select {
            padding: 12px;
            font-size: 14px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            width: 100%;
            box-sizing: border-box;
            background-color: #fafafa;
            transition: border-color 0.3s ease;
        }

        .payment-content input:focus, .payment-content select:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .card-details {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 15px;
        }

        .bank-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .payment-content p {
            font-size: 13px;
            color: #6b7280;
            margin: 10px 0;
        }

        .submit-btn {
            background: var(--primary-color);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .submit-btn:hover {
            background: #0a969a;
        }

        .submit-btn:disabled {
            background: #d1d5db;
            cursor: not-allowed;
        }

        /* Success Message */
        .success-message {
            display: none;
            text-align: center;
            padding: 20px;
            background-color: var(--success-color);
            color: white;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 500px;
            animation: fadeIn 0.5s ease;
        }

        .success-message h3 {
            margin: 0 0 10px;
            font-size: 20px;
        }

        .success-message p {
            margin: 0;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
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
            .checkout-container {
                flex-direction: column;
                padding: 0 15px;
            }

            .plan-summary, .payment-form {
                max-width: 100%;
            }

            .card-details, .bank-details {
                grid-template-columns: 1fr;
            }

            .payment-tabs {
                flex-direction: column;
                border-radius: 8px;
            }

            .payment-tabs button {
                border-radius: 6px;
                padding: 10px;
            }

            header {
                flex-direction: column;
                gap: 15px;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <a href="{{url('/')}}" style="text-decoration: none;"><div class="logo">DERMASCAN</div></a>         <nav>
            <ul>
                <li><a href="{{route('getcheck')}}">Get checked</a></li>
                <li><a href="{{route('aboutus')}}">About us</a></li>
                <li><a href="{{route('skinguide')}}">Skin Guide</a></li>
                <li><a href="{{route('research')}}">Research</a></li>
                <li><a href="{{route('contactus')}}">contact us</a></li>
                <li><a href="{{route('pharmacy')}}"><i class="fas fa-capsules" style="margin-right: 7px;"></i>Pharmacy</a></li>
                <li><a href="{{route('login')}}" class="button2"><i class="fas fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    <!-- Checkout Section -->
    <div class="checkout-container">
        <!-- Plan Summary -->
        <div class="plan-summary">
            <h2>Premium Plan</h2>
            <p>Your subscription includes unlimited skin health features.</p>
            <div class="price" id="plan-price">Rs.3000 /month (Billed Annually)</div>
            <ul class="features">
                <li><i class="fas fa-check"></i> Unlimited Skin Checks</li>
                <li><i class="fas fa-check"></i> Unlimited Data Storage</li>
                <li><i class="fas fa-check"></i> 24/7 Expert Support</li>
            </ul>
        </div>

        <!-- Payment Form -->
        <div class="payment-form">
            <h2>Payment Details</h2>
            <div class="payment-tabs">
                <button class="tab-btn active" data-tab="credit-card"><i class="fas fa-credit-card"></i> Card</button>
                <button class="tab-btn" data-tab="paypal"><i class="fab fa-paypal"></i> PayPal</button>
                <button class="tab-btn" data-tab="apple-pay"><i class="fab fa-apple-pay"></i> Apple Pay</button>
                <button class="tab-btn" data-tab="google-pay"><i class="fab fa-google-pay"></i> Google Pay</button>
                <button class="tab-btn" data-tab="bank-transfer"><i class="fas fa-university"></i> Bank Transfer</button>
            </div>

            <!-- Credit/Debit Card -->
            <form id="credit-card" class="payment-content active">
                <label for="cc-name">Full Name</label>
                <input type="text" id="cc-name" placeholder="Enter full name" required>
                <label for="cc-email">Email Address</label>
                <input type="email" id="cc-email" placeholder="example@gmail.com" required>
                <label for="cc-number">Card Number</label>
                <input type="text" id="cc-number" placeholder="1234 5678 9012 3456" maxlength="19" required>
                <div class="card-details">
                    <div>
                        <label for="cc-expiry">Expiry Date</label>
                        <input type="text" id="cc-expiry" placeholder="MM/YY" maxlength="5" required>
                    </div>
                    <div>
                        <label for="cc-cvv">CVV</label>
                        <input type="text" id="cc-cvv" placeholder="123" maxlength="3" required>
                    </div>
                </div>
                <button type="submit" class="submit-btn" id="cc-submit">Pay Now</button>
            </form>

            <!-- PayPal -->
            <form id="paypal" class="payment-content">
                <label for="pp-email">PayPal Email</label>
                <input type="email" id="pp-email" placeholder="paypal@example.com" required>
                <p>You’ll be redirected to PayPal to complete your payment.</p>
                <button type="submit" class="submit-btn" id="pp-submit">Pay Now</button>
            </form>

            <!-- Apple Pay -->
            <form id="apple-pay" class="payment-content">
                <p>Use Apple Pay for a seamless payment experience. Ensure your device is compatible.</p>
                <button type="submit" class="submit-btn" id="ap-submit">Pay Now</button>
            </form>

            <!-- Google Pay -->
            <form id="google-pay" class="payment-content">
                <p>Use Google Pay for a quick checkout. Ensure your device is compatible.</p>
                <button type="submit" class="submit-btn" id="gp-submit">Pay Now</button>
            </form>

            <!-- Bank Transfer -->
            <form id="bank-transfer" class="payment-content">
                <label for="bt-account">Account Holder Name</label>
                <input type="text" id="bt-account" placeholder="Enter full name" required>
                <div class="bank-details">
                    <div>
                        <label for="bt-bank">Bank Name</label>
                        <input type="text" id="bt-bank" placeholder="e.g., HDFC Bank" required>
                    </div>
                    <div>
                        <label for="bt-account-no">Account Number</label>
                        <input type="text" id="bt-account-no" placeholder="1234567890" required>
                    </div>
                </div>
                <label for="bt-ifsc">IFSC Code</label>
                <input type="text" id="bt-ifsc" placeholder="e.g., HDFC0001234" required>
                <p>Submit details and transfer the amount to the provided account.</p>
                <button type="submit" class="submit-btn" id="bt-submit">Submit Details</button>
            </form>
        </div>
    </div>

    <!-- Success Message -->
    <div class="success-message" id="success-message">
        <h3>Payment Successful</h3>
        <p>Your Premium Plan is now active. Check your email for confirmation.</p>
    </div>

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

    <!-- JavaScript -->
    <script>
        // Get billing from URL
        const urlParams = new URLSearchParams(window.location.search);
        const billing = urlParams.get('billing') || 'annual';
        const planPrice = document.getElementById('plan-price');
        if (billing === 'monthly') {
            planPrice.textContent = 'Rs.6000 /month (Billed Monthly)';
        } else {
            planPrice.textContent = 'Rs.3000 /month (Billed Annually)';
        }

        // Tab Switching
        const tabs = document.querySelectorAll('.tab-btn');
        const contents = document.querySelectorAll('.payment-content');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));
                tab.classList.add('active');
                document.getElementById(tab.dataset.tab).classList.add('active');
            });
        });

        // Credit Card Formatting
        document.getElementById('cc-number').addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '').substring(0, 16);
            e.target.value = value.replace(/(\d{4})/g, '$1 ').trim();
        });

        document.getElementById('cc-expiry').addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '').substring(0, 4);
            if (value.length > 2) {
                e.target.value = value.slice(0, 2) + '/' + value.slice(2);
            } else {
                e.target.value = value;
            }
        });

        // Form Submissions
        const forms = document.querySelectorAll('.payment-content');
        forms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const submitBtn = form.querySelector('.submit-btn');
                submitBtn.disabled = true;
                submitBtn.textContent = 'Processing...';

                // Simulate payment processing
                setTimeout(() => {
                    document.querySelector('.checkout-container').style.display = 'none';
                    document.getElementById('success-message').style.display = 'block';
                    submitBtn.disabled = false;
                    submitBtn.textContent = form.id === 'bank-transfer' ? 'Submit Details' : 'Pay Now';
                }, 2000);
            });
        });
    </script>
</body>
</html>
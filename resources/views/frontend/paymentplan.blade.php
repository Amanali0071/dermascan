<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Plans - Dermascan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS Variables (Matching Dermascan Theme) */
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
            --basic-bg: #e6fffa;        /* Light teal for Basic Plan */
            --premium-bg: #1a3c34;      /* Dark green for Premium Plan */
            --button-bg: #08afb4;       /* Button background */
            --highlight-color: #ff6f61; /* Coral for accents */
            --toggle-bg: #f1f5f9;       /* Light gray for toggle background */
            --toggle-active-bg: linear-gradient(45deg, #08afb4, #0a969a); /* Gradient for active toggle */
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

        /* Pricing Section */
        .pricing-section {
            padding: 40px 20px;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            transition: background-color 0.5s ease;
        }

        .pricing-section.annual {
            background-color: #f8fffe;
        }

        .pricing-section.monthly {
            background-color: #fff8f8;
        }

        .pricing-section h2 {
            color: var(--heading-color);
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            margin-bottom: 10px;
        }

        .pricing-section p {
            font-size: 16px;
            color: var(--text-color);
            margin-bottom: 20px;
        }

        /* Toggle Buttons */
        .toggle-buttons {
            display: inline-flex;
            background-color: var(--toggle-bg);
            border-radius: 25px;
            padding: 5px;
            position: relative;
            margin-bottom: 30px;
        }

        .toggle-buttons .slider {
            position: absolute;
            top: 5px;
            bottom: 5px;
            width: 50%;
            background: var(--toggle-active-bg);
            border-radius: 20px;
            transition: transform 0.3s ease;
        }

        .toggle-buttons button {
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            background: none;
            color: var(--text-color);
            cursor: pointer;
            z-index: 1;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .toggle-buttons button.active {
            color: white;
        }

        .toggle-buttons button:not(.active):hover {
            color: var(--primary-color);
        }

        .toggle-buttons .annual.active ~ .slider {
            transform: translateX(0);
        }

        .toggle-buttons .monthly.active ~ .slider {
            transform: translateX(100%);
        }

        /* Pricing Plans */
        .pricing-plans {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .plan-card {
            background-color: var(--card-bg);
            border-radius: 15px;
            padding: 30px;
            text-align: left;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 2px solid transparent;
        }

        .plan-card.basic {
            background-color: var(--basic-bg);
        }

        .plan-card.premium {
            background-color: var(--premium-bg);
            color: var(--footer-text);
        }

        .plan-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Annual Subscription Styles */
        .annual .plan-card.basic {
            border: 2px solid var(--primary-color);
        }

        .annual .plan-card.premium {
            border: 2px solid var(--primary-color);
            box-shadow: 0 0 15px rgba(8, 175, 180, 0.5);
        }

        /* Monthly Subscription Styles */
        .monthly .plan-card.basic {
            border: 2px solid var(--secondary-color);
        }

        .monthly .plan-card.premium {
            border: 2px solid var(--secondary-color);
            box-shadow: 0 0 15px rgba(255, 111, 97, 0.5);
        }

        .plan-card h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .plan-card .price {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            animation: fadeIn 0.5s ease;
        }

        .plan-card .price span {
            font-size: 14px;
            font-weight: 400;
        }

        .plan-card .highlight {
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--heading-color);
            margin-bottom: 15px;
        }

        .plan-card.premium .highlight {
            color: var(--footer-text);
        }

        .plan-card ul {
            list-style: none;
            padding: 0;
            margin-bottom: 20px;
            animation: fadeIn 0.5s ease;
        }

        .plan-card li {
            font-size: 14px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .plan-card li i {
            color: var(--primary-color);
        }

        .plan-card .select-button {
            display: inline-block;
            padding: 12px 25px;
            font-size: 16px;
            background: linear-gradient(45deg, var(--primary-color), #0a969a);
            color: white;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 35%;
            text-align: center;
        }

        .plan-card .select-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .billing-tag {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--highlight-color);
            color: white;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 15px;
            text-transform: uppercase;
        }

        .recommended-tag {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background-color: var(--primary-color);
            color: white;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 15px;
            text-transform: uppercase;
            display: none;
        }

        .annual .plan-card.premium .recommended-tag {
            display: block;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            .pricing-section {
                padding: 20px;
            }

            .pricing-section h2 {
                font-size: 28px;
            }

            .pricing-plans {
                grid-template-columns: 1fr;
            }

            .toggle-buttons button {
                padding: 8px 15px;
                font-size: 12px;
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
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Pricing Plans</h1>
            <p>Choose the Best Plan for Your Skin Health</p>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section annual">
        <h2>Pricing Plans</h2>
        <p>Choose the best plan that suits your skin health needs.</p>

        <!-- Toggle Buttons -->
        <div class="toggle-buttons">
            <button class="annual active"><i class="fas fa-calendar-alt"></i> Annual Subscription</button>
            <button class="monthly"><i class="fas fa-clock"></i> Monthly Subscription</button>
            <div class="slider"></div>
        </div>

        <!-- Pricing Plans -->
        <div class="pricing-plans">
            <!-- Basic Plan -->
            <div class="plan-card basic">
                <h3>Basic Plan</h3>
                <div class="highlight">COMPLIMENTARY</div>
                <p>Begin your skin health journey today.</p>
                <ul>
                    <li><i class="fas fa-check"></i> 5 GB Image Storage</li>
                    <li><i class="fas fa-check"></i> Standard Customer Support</li>
                    <li><i class="fas fa-check"></i> Access to Community Forum</li>
                </ul>
                <a href="reportdetail.html" class="select-button">Select This Plan</a>
            </div>

            <!-- Premium Plan -->
            <div class="plan-card premium">
                <h3>Premium Plan</h3>
                <div class="price">Rs.3000 <span>/month</span></div>
                <div class="highlight">Explore Unlimited Features</div>
                <ul>
                    <li><i class="fas fa-check"></i> Unlimited Skin Checks</li>
                    <li><i class="fas fa-check"></i> Unlimited Data Storage</li>
                    <li><i class="fas fa-check"></i> 24/7 Expert Support</li>
                </ul>
                <a href="premiumplan.html" class="select-button">Select This Plan</a>
                <div class="billing-tag">Billed Annually</div>
                <div class="recommended-tag">Recommended</div>
            </div>
        </div>
    </section>

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

    <!-- JavaScript for Toggle Buttons -->
    <script>
        document.querySelectorAll('.toggle-buttons button').forEach(button => {
            button.addEventListener('click', () => {
                // Toggle active class for buttons
                document.querySelectorAll('.toggle-buttons button').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                // Update pricing section class for styling
                const pricingSection = document.querySelector('.pricing-section');
                pricingSection.classList.remove('annual', 'monthly');
                if (button.classList.contains('annual')) {
                    pricingSection.classList.add('annual');
                } else {
                    pricingSection.classList.add('monthly');
                }

                // Update pricing based on toggle
                const priceElement = document.querySelector('.plan-card.premium .price');
                if (button.classList.contains('annual')) {
                    priceElement.innerHTML = 'Rs.3000 <span>/month</span>';
                } else {
                    priceElement.innerHTML = 'Rs.6000 <span>/month</span>';
                }
            });
        });
    </script>
</body>
</html>
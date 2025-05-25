<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Skincare Report - Dermascan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #08afb4;
            --secondary-color: #088f94;
            --text-color: #2d3748;
            --heading-color: #1a202c;
            --background-color: #f9fafb;
            --footer-bg: #2d3748;
            --footer-text: #edf2f7;
            --card-bg: #ffffff;
            --gradient-start: #e6fffa;
            --shadow: 0 4px 8px rgba(255, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background-color);
        }

        header {
            background-color: var(--background-color);
            box-shadow: var(--shadow);
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

        .tagline {
            font-size: 14px;
            color: var(--text-color);
            margin-top: 5px;
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

        .hero {
            background-image: linear-gradient(to bottom, var(--gradient-start), var(--background-color));
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--heading-color);
        }

        .hero-content {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .hero-content a {
            text-decoration: none;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 20px;
        }

        .hero .button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 18px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 25px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
            border: 2px solid var(--primary-color);
        }

        .hero .button:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            background:var(--secondary-color);
            border: 2px solid --primary-color;
            
            

        }

        .insights-section {
            padding: 40px 20px;
            max-width: 900px;
            margin: 0 auto;
        }

        .report-description {
            margin-bottom: 40px;
        }

        .report-description h2 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            color: var(--heading-color);
            margin-bottom: 15px;
        }

        .report-description p {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .reports-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .insights-card {
            background-color: var(--card-bg);
            padding: 20px;
            border-radius: 10px;
            box-shadow: var(--shadow);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .insights-card:hover {
            transform: translateY(-5px);
        }

        .insights-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: var(--heading-color);
            margin-bottom: 10px;
        }

        .insights-card p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .insights-card .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background: linear-gradient(45deg, var(--primary-color), #0a969a);
            color: white;
            border: none;
            border-radius: 25px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
            text-decoration: none;
        }

        .insights-card .button:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            background: #0a969a;
        }

        .button i {
            margin-right: 8px;
        }

        .faq-section {
            margin-top: 40px;
        }

        .faq-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            color: var(--heading-color);
            margin-bottom: 20px;
        }

        .faq-item {
            margin-bottom: 20px;
        }

        .faq-item h4 {
            font-size: 18px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .faq-item p {
            font-size: 14px;
        }

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

        .copyright {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #a0aec0;
        }

        @media (max-width: 768px) {
            .insights-section {
                padding: 20px;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero p {
                font-size: 16px;
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
    <section class="hero">
        <div class="hero-content">
            <h1>Your Basic Skincare Report</h1>
            <p>Access your basic skincare analysis report.</p>
            <a href="basic_report.pdf" download class="button"><i class="fas fa-download"></i> Download Basic Report</a>
        </div>
    </section>

    <main>
        <section class="insights-section">
            <div class="report-description">
                <h2>What’s Included in Your Basic Report</h2>
                <p>The basic report provides a summary of your skin analysis, including key insights into your skin type, common concerns, and general recommendations for improvement. It’s a great starting point for understanding your skin’s needs.</p>
            </div>
            <div class="faq-section">
                <h2>Frequently Asked Questions</h2>
                <div class="faq-item">
                    <h4>What is included in the basic report?</h4>
                    <p>The basic report includes an overview of your skin type, identified concerns, and general skincare tips.</p>
                </div>
                <div class="faq-item">
                    <h4>Can I upgrade to a detailed report later?</h4>
                    <p>Yes, you can upgrade to a detailed report at any time for more in-depth analysis and personalized recommendations.</p>
                </div>
                <div class="faq-item">
                    <h4>How often should I get a skincare report?</h4>
                    <p>We recommend getting a new report every 3-6 months to track your skin’s progress and adjust your routine accordingly.</p>
                </div>
            </div>
        </section>
    </main>

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
        <div class="copyright">
            <p>© 2023 Dermascan. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
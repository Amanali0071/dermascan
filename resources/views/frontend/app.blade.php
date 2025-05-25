<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DermaScan</title>
    {{-- <link rel="stylesheet" href="style.css"> --}}
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">DERMASCAN</div>
        <nav>
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
    <main>
        <section class="intro">
            <div class="intro-text">
                <p>Online Dermatologist ></p> <a href="{{route('doctor-list')}}" class="ask">Ask a Dermatologist</a>
                <h1>Ask a Board-Certified Dermatologist</h1>
                <p>Securely upload your symptoms and pictures below. A dermatologist will respond with the most likely condition and treatment options.</p>
                <p>Simple, Effective, Certified. From 10,000 PKR For A Consultation!</p>
                <p>(pricing based on selected response time)</p>
            </div>
            <div class="dermatologists">
                
                <div class="images">
                  <a href="{{route('doctor-list')}}"><img src="{{asset('frontend/images/doctor1.JPG')}}" alt="Doctor 1"></a>  
                   <a href="{{route('doctor-list')}}"> <img src="{{asset('frontend/images/doctor2.JPG')}}" alt="Doctor 2"></a>
                </div>
                <p>See our team of board certified dermatologists</p>
            </div>
        </section>
        <section class="testimonials">
            <h2>Testimonials</h2>
            <p>Fantastic! Meet a dermatologist within hours!</p>
            <p>Extremely quick and easy to submit. Received an answer within half the expected time, and it saved me from weeks of unnecessary panic waiting for an appointment with my doctors.</p>
            <p>DermaScan users – 2025</p>
            <p>Read what our users have to say – testimonials</p>
        </section>
        <section class="features">
            <h2>Why Choose Us</h2>
            <ul>
                <li>✓ We catch skin diseases early</li>
                <li>✓ Complete anonymity and data protection</li>
                <li>✓ 70% do not need to see a doctor in person</li>
                <li>✓ Secure credit card processing by PayPal</li>
                <li>✓ Response guaranteed as fast as 8 hours</li>
                <li>✓ Over 200,000 satisfied customers</li>
                <li>✓ From 10,000 for an answer</li>
            </ul>
        </section>
        <section class="payment">
            <h2>Fast and Secure Payment Options</h2>
            <p>We accept all major credit cards and health savings accounts</p>
        </section>
        <section class="guidelines">
            <h2>Get the Most from Your Online Dermatology Consultation</h2>
            <p>Follow these guidelines for a more precise consultation</p>
            <div class="step">
                <h3>I. SNAP 2 CLEAR PHOTOS</h3>
                <ul>
                    <li>Take well-lit, clear photos of the affected area.</li>
                    <li>Bare Skin: Ensure the skin is free of any makeup, skin treatments, heavy moisturizers and/or nail polish (for concerns on the hands or feet)</li>
                    <li>No Filters: Make sure there aren’t any filters applied on the smartphone camera when taking photos.</li>
                </ul>
            </div>
            <div class="step">
                <h3>II. PROVIDING YOUR MEDICAL INFORMATION</h3>
                <ul>
                    <li>Detailed History: Share any relevant medical information, including both current and past skin conditions</li>
                    <li>Family History and Allergies: Include any known family history of skin conditions, allergies, or reactions to medications or skin care products.</li>
                    <li>Current Medications: List any medications you are currently taking, as these can influence your skin condition and the treatment options available to you.</li>
                </ul>
            </div>
        </section>
        <section class="statistics">
            <h2>More Than 70%</h2>
            <p>Of First Derm users get better following consultations with our board-certified dermatologists.</p>
            <p>Skip the Long Waits & Connect With Top Dermatologists Online.</p>
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
    </footer>
</body>
</html>
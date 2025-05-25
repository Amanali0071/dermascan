<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - DermaScan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;600;700&display=swap"
        rel="stylesheet">
    <style>
        /* CSS Variables */
        :root {
            --primary-color: #08afb4;
            /* Vibrant teal */
            --secondary-color: #08afb4;
            /* Coral accent */
            --text-color: #2d3748;
            /* Dark slate */
            --heading-color: #08afb4;
            /* Near black */
            --background-color: #ffffff;
            /* Light background */
            --footer-bg: #2d3748;
            /* Dark slate footer */
            --footer-text: #edf2f7;
            /* Light footer text */
            --card-bg: #ffffff;
            /* White for cards */
            --gradient-start: #e6fffa;
            /* Light teal gradient */
        }

        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: var(--text-color);
        }

        main {
            background: white;
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

        /* Media Query for Responsive Navigation */
        @media (max-width: 768px) {
            nav ul {
                display: none;
            }
        }

        /* Sign-Up Form Styles */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

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

        .input-focus {
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .input-focus:focus {
            border-color: #08afb4;
            box-shadow: 0 0 0 3px rgba(8, 175, 180, 0.2);
            outline: none;
        }
    </style>
</head>

<body class="bg-gray-100">
    <header>
        <a href="{{ url('/') }}" style="text-decoration: none;">
            <div class="logo">DERMASCAN</div>
        </a>
        <nav>
            <ul>
                <li><a href="{{ route('getcheck') }}">Get checked</a></li>
                <li><a href="{{ route('aboutus') }}">About us</a></li>
                <li><a href="{{ route('skinguide') }}">Skin Guide</a></li>
                <li><a href="{{ route('research') }}">Research</a></li>
                <li><a href="{{ route('contactus') }}">contact us</a></li>
                <li><a href="{{ route('pharmacy') }}"><i class="fas fa-capsules"
                            style="margin-right: 7px;"></i>Pharmacy</a></li>
                <li><a href="{{ route('login') }}" class="button2"><i class="fas fa-user"></i></a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen flex items-center justify-center py-12">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full fade-in" style="border: 0.5px solid darkgray;">
            <h1 class="text-3xl font-bold text-gray-700 text-center mb-4">Create Your Account</h1>
            <p class="text-gray-600 text-center mb-6">Join DermaScan for expert dermatology consultations.</p>

            <!-- Google Sign-Up Button -->
            <div id="googleSignInButton" class="mb-6"></div>

            <!-- Facebook Sign-Up Button -->
            <button id="facebookSignInButton"
                class="w-full bg-blue-400 text-white p-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 mb-4"
                onclick="facebookSignUp()">
                <i class="fab fa-facebook-f mr-2"></i> Sign up with Facebook
            </button>

            <div class="flex items-center justify-center my-6">
                <span class="border-t flex-grow"></span>
                <span class="px-4 text-gray-500">or</span>
                <span class="border-t flex-grow"></span>
            </div>

            <!-- Sign-Up Form -->
            <form method="POST" action="{{ route('doctorstore') }}">
                @csrf
                <div class="mb-4">
                    <label for="fullname" class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" id="fullname" placeholder="Enter your full name"
                        class="w-full p-3 border rounded-lg input-focus" required>
                    <p id="fullname-feedback" class="text-sm text-gray-500 mt-1"></p>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email"
                        class="w-full p-3 border rounded-lg input-focus" required>
                    <p id="email-feedback" class="text-sm text-gray-500 mt-1"></p>
                </div>

                <div class="mb-4 relative">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" placeholder="Create a password"
                        class="w-full p-3 border rounded-lg input-focus" required>
                    <i class="fas fa-eye absolute right-3 top-11 text-gray-500 cursor-pointer toggle-password"
                        data-target="password"></i>
                    <p id="password-feedback" class="text-sm text-gray-500 mt-1"></p>
                </div>

                <div class="mb-6 relative">
                    <label for="confirm-password" class="block text-sm font-semibold text-gray-700 mb-1">Confirm
                        Password</label>
                    <input type="password" name="password_confirmation" id="confirm-password"
                        placeholder="Confirm your password" class="w-full p-3 border rounded-lg input-focus" required>
                    <i class="fas fa-eye absolute right-3 top-11 text-gray-500 cursor-pointer toggle-password"
                        data-target="confirm-password"></i>
                    <p id="confirm-password-feedback" class="text-sm text-gray-500 mt-1"></p>
                </div>

                <button type="submit"
                    class="w-full border-2 border-teal-500 text-teal-500 p-3 rounded-lg font-semibold hover:bg-teal-500 hover:text-black hover:bg-blue-100 transition duration-300">
                    Sign Up
                </button>
            </form>


            <p class="text-center mt-4">Sign Up as a Patient ? <a href="{{ route('register') }}"
                    class="text-teal-500 hover:text-teal-700">Sign Up</a></p>
            <p class="text-center mt-4">Already have an account? <a href="{{ route('login') }}"
                    class="text-teal-500 hover:text-teal-700">Login here</a></p>
        </div>
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

    <!-- Scripts -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    <script>
        // Facebook SDK Initialization
        window.fbAsyncInit = function() {
            FB.init({
                appId: 'YOUR_FACEBOOK_APP_ID', // Replace with your Facebook App ID
                cookie: true,
                xfbml: true,
                version: 'v12.0'
            });
        };

        // Google Sign-In Initialization
        window.onload = function() {
            google.accounts.id.initialize({
                client_id: 'YOUR_GOOGLE_CLIENT_ID', // Replace with your Google Client ID
                callback: handleGoogleSignIn
            });
            google.accounts.id.renderButton(
                document.getElementById('googleSignInButton'), {
                    theme: 'outline',
                    size: 'large',
                    width: '100%',
                    text: 'signup_with'
                }
            );
        };

        function handleGoogleSignIn(response) {
            const credential = response.credential;
            console.log('Google ID Token:', credential);
            alert('Google Sign-Up Successful! Check console for token.');
            // Send 'credential' to your server for verification and user creation
        }

        function facebookSignUp() {
            FB.login(function(response) {
                if (response.authResponse) {
                    FB.api('/me', {
                        fields: 'name,email'
                    }, function(response) {
                        console.log('Facebook User Info:', response);
                        alert('Facebook Sign-Up Successful! Check console for user info.');
                        // Send response to your server
                    });
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            }, {
                scope: 'public_profile,email'
            });
        }

        // Show/Hide Password
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', () => {
                const targetId = toggle.getAttribute('data-target');
                const input = document.getElementById(targetId);
                input.type = input.type === 'password' ? 'text' : 'password';
                toggle.classList.toggle('fa-eye');
                toggle.classList.toggle('fa-eye-slash');
            });
        });

        // Input Validation
        const fullname = document.getElementById('fullname');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm-password');
        const fullnameFeedback = document.getElementById('fullname-feedback');
        const emailFeedback = document.getElementById('email-feedback');
        const passwordFeedback = document.getElementById('password-feedback');
        const confirmPasswordFeedback = document.getElementById('confirm-password-feedback');
        const submitBtn = document.getElementById('submit-btn');

        // Full Name Validation (alphabets and spaces only)
        fullname.addEventListener('input', () => {
            const regex = /^[a-zA-Z\s]*$/;
            if (!regex.test(fullname.value)) {
                fullnameFeedback.textContent = 'Name should contain only alphabets and spaces.';
                fullnameFeedback.classList.add('text-red-500');
                fullnameFeedback.classList.remove('text-green-500');
            } else if (fullname.value.trim() === '') {
                fullnameFeedback.textContent = 'Full name is required.';
                fullnameFeedback.classList.add('text-red-500');
                fullnameFeedback.classList.remove('text-green-500');
            } else {
                fullnameFeedback.textContent = '';
                fullnameFeedback.classList.remove('text-red-500');
            }
        });

        // Email Validation
        email.addEventListener('input', () => {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regex.test(email.value)) {
                emailFeedback.textContent = 'Please enter a valid email address.';
                emailFeedback.classList.add('text-red-500');
                emailFeedback.classList.remove('text-green-500');
            } else if (email.value.trim() === '') {
                emailFeedback.textContent = 'Email is required.';
                emailFeedback.classList.add('text-red-500');
                emailFeedback.classList.remove('text-green-500');
            } else {
                emailFeedback.textContent = '';
                emailFeedback.classList.remove('text-red-500');
            }
        });

        // Password Validation
        password.addEventListener('input', () => {
            const regex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[0-9]).{8,}$/;
            if (!regex.test(password.value)) {
                passwordFeedback.textContent =
                    'Must include 1 capital letter, 1 special character, small letters, numbers, and be 8+ characters.';
                passwordFeedback.classList.add('text-red-500');
                passwordFeedback.classList.remove('text-green-500');
            } else if (password.value.trim() === '') {
                passwordFeedback.textContent = 'Password is required.';
                passwordFeedback.classList.add('text-red-500');
                passwordFeedback.classList.remove('text-green-500');
            } else {
                passwordFeedback.textContent = 'Password meets requirements!';
                passwordFeedback.classList.add('text-green-500');
                passwordFeedback.classList.remove('text-red-500');
            }
        });

        // Confirm Password Validation
        confirmPassword.addEventListener('input', () => {
            if (confirmPassword.value !== password.value) {
                confirmPasswordFeedback.textContent = 'Passwords do not match.';
                confirmPasswordFeedback.classList.add('text-red-500');
                confirmPasswordFeedback.classList.remove('text-green-500');
            } else if (confirmPassword.value.trim() === '') {
                confirmPasswordFeedback.textContent = 'Confirm password is required.';
                confirmPasswordFeedback.classList.add('text-red-500');
                confirmPasswordFeedback.classList.remove('text-green-500');
            } else {
                confirmPasswordFeedback.textContent = 'Passwords match!';
                confirmPasswordFeedback.classList.add('text-green-500');
                confirmPasswordFeedback.classList.remove('text-red-500');
            }
        });

        // Form Submission
        submitBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const nameRegex = /^[a-zA-Z\s]+$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[0-9]).{8,}$/;

            let isValid = true;

            // Check Full Name
            if (!nameRegex.test(fullname.value) || fullname.value.trim() === '') {
                fullnameFeedback.textContent = 'Please enter a valid full name (alphabets and spaces only).';
                fullnameFeedback.classList.add('text-red-500');
                isValid = false;
            }

            // Check Email
            if (!emailRegex.test(email.value) || email.value.trim() === '') {
                emailFeedback.textContent = 'Please enter a valid email address.';
                emailFeedback.classList.add('text-red-500');
                isValid = false;
            }

            // Check Password
            if (!passwordRegex.test(password.value) || password.value.trim() === '') {
                passwordFeedback.textContent = 'Password does not meet requirements.';
                passwordFeedback.classList.add('text-red-500');
                isValid = false;
            }

            // Check Confirm Password
            if (password.value !== confirmPassword.value || confirmPassword.value.trim() === '') {
                confirmPasswordFeedback.textContent = 'Passwords do not match.';
                confirmPasswordFeedback.classList.add('text-red-500');
                isValid = false;
            }

            if (isValid) {
                alert('Sign-Up Successful! (Manual sign-up simulation)');
                // Send form data to your server here
            }
        });
    </script>
</body>

</html>

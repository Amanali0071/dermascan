<!DOCTYPE html>
<html>
<head>
    <title>Stripe Card Payment</title>
        <link rel="stylesheet" href="{{ asset('frontend/css/getcheck.css') }}">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            margin-bottom: 10px;
        }
        #card-errors {
            color: red;
            margin-bottom: 10px;
        }
        #payment-form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            background: #fafafa;
        }
        button {
            background: #5469d4;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:disabled {
            background: #ccc;
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
    
    <div style="max-width: 450px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); padding: 30px 25px;">
        <h2 style="text-align:center; margin-bottom: 25px;">Become Premium Member <span style="color:#08afb4;">IN $10</span></h2>
        @if(auth()->check() && auth()->user()->is_premium == 1)
            <div style="text-align:center; color:green; font-weight:bold; font-size:18px;">
                You are already a premium member
            </div>
        @else
            <form id="payment-form">
                <div id="card-element" class="StripeElement"></div>
                <div id="card-errors" role="alert"></div>
                <button id="submit">Pay</button>
            </form>
        @endif
    </div>
    <div id="payment-success" style="display:none; color:green; text-align:center;">
        Payment successful!
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

    <script>
        // Replace with your own publishable key
        const stripe = Stripe('{{ config('services.stripe.key') }}');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        card.on('change', function(event) {
            document.getElementById('card-errors').textContent = event.error ? event.error.message : '';
        });

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            document.getElementById('submit').disabled = true;

            // Create a token using the card details
            const {token, error} = await stripe.createToken(card);

            if (error) {
                document.getElementById('card-errors').textContent = error.message;
                document.getElementById('submit').disabled = false;
                return;
            }

            // Send the token to your server
            fetch('/create-payment-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    amount: 1000, // $10.00
                    stripeToken: token.id
                })
            })
            .then(r => r.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('card-errors').textContent = data.error;
                    document.getElementById('submit').disabled = false;
                } else {
                    form.style.display = 'none';
                    document.getElementById('payment-success').style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>
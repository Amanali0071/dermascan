<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Payment Method</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* CSS Variables for Consistency */
        :root {
            --primary-color: #00b4b8;    /* Professional teal */
            --secondary-color: #ff6f61;  /* Accent coral */
            --text-color: #1a202c;      /* Dark gray for readability */
            --background-color: #f9fafb; /* Soft off-white */
            --card-bg: #ffffff;         /* Pure white for cards */
            --shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        /* Base Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: var(--background-color);
            color: var(--text-color);
            line-height: 1.6;
        }

        /* Payment Container */
        .payment-container {
            max-width: 960px;
            margin: 0 auto;
            padding: 40px;
            background-color: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow);
        }

        .payment-container h2 {
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 40px;
        }

        /* Payment Options Grid */
        .payment-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 40px;
        }

        .payment-option {
            background-color: var(--card-bg);
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .payment-option:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(0, 180, 184, 0.2);
        }

        .payment-option.active {
            border-color: var(--primary-color);
            background-color: #e6fffa;
            box-shadow: 0 4px 12px rgba(0, 180, 184, 0.3);
        }

        .payment-option i {
            font-size: 48px;
            color: var(--primary-color);
            margin-bottom: 15px;
            display: block;
        }

        .payment-option p {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        /* Payment Forms */
        .payment-form {
            display: none;
            background-color: #f1f5f9;
            padding: 25px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }

        .payment-form.active {
            display: block;
        }

        .payment-form p {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 20px;
        }

        .payment-form label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .payment-form input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 16px;
            margin-bottom: 20px;
            box-sizing: border-box;
            transition: border-color 0.2s ease;
        }

        .payment-form input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 180, 184, 0.2);
        }

        .payment-form button {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .payment-form button:hover {
            background-color: #009fa3;
        }

        /* PayPal-Specific Button */
        #paypal-form button {
            background-color: #0070ba;
        }

        #paypal-form button:hover {
            background-color: #005ea6;
        }

        /* Security Note */
        .security-note {
            margin-top: 30px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #6b7280;
        }

        .security-note i {
            color: var(--primary-color);
            margin-right: 10px;
            font-size: 16px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .payment-options {
                grid-template-columns: 1fr;
            }

            .payment-container {
                padding: 20px;
            }

            .payment-option i {
                font-size: 40px;
            }

            .payment-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>Add a Payment Method</h2>
        <div class="payment-options">
            <div class="payment-option active" data-method="credit-card" tabindex="0" role="button">
                <i class="fas fa-credit-card"></i>
                <p>Credit Card</p>
            </div>
            <div class="payment-option" data-method="paypal" tabindex="0" role="button">
                <i class="fab fa-paypal"></i>
                <p>PayPal</p>
            </div>
            <div class="payment-option" data-method="bank-transfer" tabindex="0" role="button">
                <i class="fas fa-university"></i>
                <p>Bank Transfer</p>
            </div>
        </div>
        <div class="payment-forms">
            <!-- Credit Card Form -->
            <form id="credit-card-form" class="payment-form active">
                <p>Please enter your credit card details to add this payment method.</p>
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" placeholder="1234 5678 9012 3456" required pattern="\d{4}\s?\d{4}\s?\d{4}\s?\d{4}">
                <label for="expiration">Expiration Date</label>
                <input type="text" id="expiration" placeholder="MM/YY" required pattern="\d{2}/\d{2}">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" placeholder="123" required pattern="\d{3,4}">
                <label for="card-name">Cardholder Name</label>
                <input type="text" id="card-name" placeholder="John Doe" required>
                <label for="billing-address">Billing Address</label>
                <input type="text" id="billing-address" placeholder="123 Main St, City, Country" required>
                <button type="submit">Add Credit Card</button>
            </form>
            <!-- PayPal Form -->
            <form id="paypal-form" class="payment-form">
                <p>Enter your PayPal email to link your account securely.</p>
                <label for="paypal-email">PayPal Email</label>
                <input type="email" id="paypal-email" placeholder="example@paypal.com" required>
                <button type="submit">Add PayPal</button>
            </form>
            <!-- Bank Transfer Form -->
            <form id="bank-transfer-form" class="payment-form">
                <p>Provide your bank details for secure bank transfer payments.</p>
                <label for="account-name">Account Holder Name</label>
                <input type="text" id="account-name" placeholder="John Doe" required>
                <label for="account-number">Account Number</label>
                <input type="text" id="account-number" placeholder="1234567890" required pattern="\d{10,16}">
                <label for="routing-number">Routing Number</label>
                <input type="text" id="routing-number" placeholder="123456789" required pattern="\d{9}">
                <label for="bank-name">Bank Name</label>
                <input type="text" id="bank-name" placeholder="Example Bank" required>
                <button type="submit">Add Bank Account</button>
            </form>
        </div>
        <div class="security-note">
            <i class="fas fa-lock"></i>
            <p>Your payment information is encrypted and secure.</p>
        </div>
    </div>

    <script>
        // Select all payment options and forms
        const paymentOptions = document.querySelectorAll('.payment-option');
        const paymentForms = document.querySelectorAll('.payment-form');

        // Handle payment method selection
        paymentOptions.forEach(option => {
            option.addEventListener('click', () => {
                // Remove active state from all options and forms
                paymentOptions.forEach(opt => opt.classList.remove('active'));
                paymentForms.forEach(form => form.classList.remove('active'));

                // Add active state to clicked option and corresponding form
                option.classList.add('active');
                const method = option.getAttribute('data-method');
                const activeForm = document.getElementById(`${method}-form`);
                if (activeForm) activeForm.classList.add('active');
            });

            // Enable keyboard navigation
            option.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    option.click();
                }
            });
        });

        // Handle form submissions
        paymentForms.forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                if (form.checkValidity()) {
                    alert('Payment method added successfully!');
                    form.reset();
                } else {
                    form.reportValidity(); // Show browser validation messages
                }
            });
        });
    </script>
</body>
</html>
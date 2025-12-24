<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #EAB308;
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .highlight-box {
            background-color: #FEF3C7;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            background-color: #EAB308;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #777;
            font-size: 12px;
        }
        .social-links {
            margin-top: 20px;
        }
        .social-links a {
            color: #EAB308;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>✅ Message Received!</h1>
            <p>Thank you for contacting Calista</p>
        </div>
        <div class="content">
            <p>Dear {{ $contact->name }},</p>

            <p>Thank you for reaching out to us! We have successfully received your message regarding <strong>"{{ $contact->subject }}"</strong>.</p>

            <div class="highlight-box">
                <p><strong>What happens next?</strong></p>
                <p>Our team will review your message and get back to you within 24-48 business hours. We appreciate your patience.</p>
            </div>

            <p><strong>Your message:</strong></p>
            <p style="background-color: white; padding: 15px; border-left: 4px solid #EAB308;">
                {{ $contact->message }}
            </p>

            @if($contact->newsletter_subscription)
            <p>✅ You've been subscribed to our newsletter! You'll receive updates about new products, special offers, and design inspiration.</p>
            @endif

            <p>If you have any urgent concerns, please don't hesitate to call us at <strong>+94 11 234 5678</strong>.</p>

            <div style="text-align: center;">
                <a href="{{ url('/') }}" class="button">Visit Our Website</a>
            </div>

            <div class="social-links" style="text-align: center;">
                <p>Follow us on:</p>
                <a href="#">Facebook</a> |
                <a href="#">Instagram</a> |
                <a href="#">Twitter</a> |
                <a href="#">LinkedIn</a>
            </div>
        </div>
        <div class="footer">
            <p><strong>Calista Furniture</strong></p>
            <p>123 Furniture Street, Colombo, Sri Lanka</p>
            <p>📧 info@calista.lk | 📞 +94 11 234 5678</p>
            <p>&copy; {{ date('Y') }} Calista. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

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
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .info-row {
            margin-bottom: 15px;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        .value {
            color: #333;
        }
        .message-box {
            background-color: white;
            padding: 15px;
            border-left: 4px solid #EAB308;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #777;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔔 New Contact Form Submission</h1>
        </div>
        <div class="content">
            <p>A new contact form has been submitted on the Calista website:</p>

            <div class="info-row">
                <span class="label">Name:</span>
                <span class="value">{{ $contact->name }}</span>
            </div>

            <div class="info-row">
                <span class="label">Email:</span>
                <span class="value">{{ $contact->email }}</span>
            </div>

            @if($contact->phone)
            <div class="info-row">
                <span class="label">Phone:</span>
                <span class="value">{{ $contact->phone }}</span>
            </div>
            @endif

            <div class="info-row">
                <span class="label">Subject:</span>
                <span class="value">{{ $contact->subject }}</span>
            </div>

            <div class="info-row">
                <span class="label">Submitted:</span>
                <span class="value">{{ $contact->created_at->format('F d, Y h:i A') }}</span>
            </div>

            @if($contact->newsletter_subscription)
            <div class="info-row">
                <span class="label">Newsletter:</span>
                <span class="value">✅ Subscribed</span>
            </div>
            @endif

            <div class="message-box">
                <p class="label">Message:</p>
                <p>{{ $contact->message }}</p>
            </div>
        </div>
        <div class="footer">
            <p>This email was sent from your Calista website contact form.</p>
            <p>&copy; {{ date('Y') }} Calista. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

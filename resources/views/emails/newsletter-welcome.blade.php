<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Nuclear Edge Newsletter</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 8px 8px 0 0;
            margin: -30px -30px 20px -30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 20px 0;
        }
        .content h2 {
            color: #667eea;
            margin-top: 0;
        }
        .benefits {
            background-color: #f8f9fa;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }
        .benefits ul {
            margin: 0;
            padding-left: 20px;
        }
        .benefits li {
            margin-bottom: 10px;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
        .social-links {
            margin: 15px 0;
        }
        .social-links a {
            color: #667eea;
            text-decoration: none;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Nuclear Edge!</h1>
            <p>Thank you for subscribing to our newsletter</p>
        </div>

        <div class="content">
            <h2>You're In!</h2>
            <p>Thank you for joining the Nuclear Edge community. We're excited to have you on board!</p>

            <div class="benefits">
                <strong>As a subscriber, you'll receive:</strong>
                <ul>
                    <li>Latest industry insights and trends</li>
                    <li>Exclusive updates on our services</li>
                    <li>Tips and best practices for digital transformation</li>
                    <li>Special announcements and offers</li>
                </ul>
            </div>

            <p>We promise to only send you valuable content that helps you stay ahead in the digital landscape.</p>

            <center>
                <a href="{{ config('app.url') }}" class="cta-button">Visit Our Website</a>
            </center>
        </div>

        <div class="footer">
            <p>You received this email because you subscribed to the Nuclear Edge newsletter.</p>
            <p>&copy; {{ date('Y') }} Nuclear Edge. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

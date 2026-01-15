<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Contact Form Submission</title>
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
            padding: 20px;
            border-radius: 8px 8px 0 0;
            margin: -30px -30px 20px -30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .field {
            margin-bottom: 15px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 6px;
        }
        .field-label {
            font-weight: 600;
            color: #667eea;
            margin-bottom: 5px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .field-value {
            color: #333;
            font-size: 16px;
        }
        .message-field {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Contact Form Submission</h1>
        </div>

        <p>You have received a new contact form submission from the Nuclear Edge website.</p>

        <div class="field">
            <div class="field-label">Name</div>
            <div class="field-value">{{ $contact->name }}</div>
        </div>

        <div class="field">
            <div class="field-label">Email</div>
            <div class="field-value">{{ $contact->email }}</div>
        </div>

        <div class="field">
            <div class="field-label">Phone</div>
            <div class="field-value">{{ $contact->phone }}</div>
        </div>

        <div class="field">
            <div class="field-label">Service Interested In</div>
            <div class="field-value">{{ $contact->services }}</div>
        </div>

        <div class="field message-field">
            <div class="field-label">Message</div>
            <div class="field-value">{{ $contact->message }}</div>
        </div>

        <div class="footer">
            <p>This email was sent from the Nuclear Edge contact form.</p>
            <p>Submitted on {{ $contact->created_at->format('F j, Y \a\t g:i A') }}</p>
        </div>
    </div>
</body>
</html>

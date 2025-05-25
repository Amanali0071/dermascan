<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #4f6df5 0%, #3a5ae8 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .email-body {
            padding: 30px;
        }
        .info-block {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .info-block:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        .label {
            font-weight: 600;
            color: #4f6df5;
            margin-bottom: 5px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .value {
            font-size: 16px;
            color: #333;
            background-color: #f9f9f9;
            padding: 12px 15px;
            border-radius: 4px;
            border-left: 3px solid #4f6df5;
        }
        .message-value {
            white-space: pre-line;
            line-height: 1.8;
        }
        .email-footer {
            background-color: #f5f7fa;
            padding: 15px 30px;
            font-size: 13px;
            color: #666;
            text-align: center;
        }
        .timestamp {
            color: #999;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>New Contact Form Submission</h1>
        </div>
        
        <div class="email-body">
            <div class="info-block">
                <div class="label">From</div>
                <div class="value">{{ $name }}</div>
            </div>
            
            <div class="info-block">
                <div class="label">Email Address</div>
                <div class="value">{{ $email }}</div>
            </div>
            
            <div class="info-block">
                <div class="label">Message</div>
                <div class="value message-value">{{ $messageContent }}</div>
            </div>
            
            <div class="timestamp">
                Submitted on {{ date('F j, Y \a\t g:i a') }}
            </div>
        </div>
        
        <div class="email-footer">
            <p>Copyright 2025, DeramScanAi</p>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .email-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(255, 165, 0, 0.5);
            width: 100%;
            max-width: 600px;
            margin: 20px;
        }

        .email-header {
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .email-header h2 {
            margin: 0;
            color: #333333;
        }

        .email-body {
            text-align: center;
        }

        .email-body p {
            font-size: 16px;
            color: #555555;
            line-height: 1.5;
            margin: 10px 0;
        }

        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #FF5722;
            margin: 20px 0;
        }

        .email-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .email-footer p {
            font-size: 14px;
            color: #999999;
            margin: 0;
        }

        @media (max-width: 600px) {
            .email-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h2>Welcome to Tale Of Tails Universe!</h2>
        </div>
        <div class="email-body">
            <p>Hey there,</p>
            <p>Your journey with Tale of Tails begins now. Use the OTP below to unlock the magic :</p>
            <p class="otp-code"> {{ $auth_otp }} </p>
            <p>Enter this code in the app to verify your account and start exploring!</p>
            <p>If you did not request this code, please ignore this message.</p>
            <p><strong>Note:</strong> This OTP is valid for 10 minutes. Keep it safe and never share it with anyone!</p>
        </div>
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Tale of Tails. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
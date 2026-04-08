<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã OTP của bạn</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4f46e5;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px 40px;
            text-align: center;
        }
        .otp-code {
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 8px;
            color: #4f46e5;
            background-color: #f8fafc;
            padding: 15px 30px;
            border-radius: 8px;
            display: inline-block;
            margin: 20px 0;
            border: 2px dashed #4f46e5;
        }
        .message {
            color: #374151;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
        }
        .warning {
            color: #ef4444;
            font-size: 14px;
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2>XÁC THỰC TÀI KHOẢN</h2>
        </div>

        <!-- Content -->
        <div class="content">
            <p class="message">
                Xin chào <strong>{{ $name ?? 'bạn' }}</strong>,
            </p>
            <p class="message">
                Đây là mã OTP để xác thực tài khoản của bạn:
            </p>

            <div class="otp-code">
                {{ $otp }}
            </div>

            <p class="message">
                Mã này sẽ hết hạn sau <strong>2 phút</strong>.<br>
                Vui lòng không chia sẻ mã này với bất kỳ ai.
            </p>

            <p class="warning">
                Nếu bạn không yêu cầu mã này, vui lòng bỏ qua email hoặc liên hệ với chúng tôi ngay.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Trân trọng,<br><strong>{{ config('app.name') }}</strong></p>
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

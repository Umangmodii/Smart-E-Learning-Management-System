<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Smart LMS — OTP</title>
    </head>
    <body style="font-family: Arial, Helvetica, sans-serif; color: #333;">
        <div style="max-width:600px;margin:0 auto;padding:20px;">
            <h2 style="margin-bottom:8px;">Smart LMS — Your OTP</h2>
            <p style="margin-top:0;">Use the following one-time password to complete sign in:</p>

            <div style="font-size:28px;letter-spacing:4px;font-weight:700;margin:18px 0;padding:12px 18px;background:#f7f7f7;border-radius:6px;text-align:center;">
                {{ $otp }}
            </div>

            <p style="color:#666;font-size:14px;">This code will expire in 2 minutes. If you did not request this, please ignore this email.</p>

            <p style="margin-top:28px;font-size:13px;color:#999;">— Smart E-Learning Team</p>
        </div>
    </body>
  
</html>
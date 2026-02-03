<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #eee; border-radius: 10px; }
        .header { text-align: center; padding-bottom: 20px; border-bottom: 2px solid #f8f9fa; }
        .content { padding: 20px 0; }
        .btn { display: inline-block; padding: 12px 25px; background-color: #0d6efd; color: #ffffff !important; text-decoration: none; border-radius: 5px; font-weight: bold; margin-top: 20px; }
        .footer { font-size: 12px; color: #777; text-align: center; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="color: #0d6efd; margin-bottom: 0;">Smart LMS</h1>
            <p style="margin-top: 5px; color: #6c757d;">Educator Network</p>
        </div>
        <div class="content">
            <h3>Hello, {{ $instructor->name }}!</h3>
            <p>We are thrilled to inform you that your application to become an instructor on <strong>Smart LMS</strong> has been officially approved!</p>
            
            <p>Our team has reviewed your profile and expertise, and we believe you will be a fantastic addition to our learning community.</p>
            
            <p><strong>What happens next?</strong></p>
            <ul>
                <li>Your Instructor Dashboard is now fully unlocked.</li>
                <li>You can start creating your first course.</li>
                <li>You can set up your payout preferences in the profile section.</li>
            </ul>

            <div style="text-align: center;">
                <a href="{{ url('/instructor/login') }}" class="btn">Login to Your Dashboard</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Smart LMS. All rights reserved.<br>
            If you did not request this, please ignore this email.</p>
        </div>
    </div>
</body>
</html>
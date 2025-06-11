<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Successfully Registered - Safety First Medical Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9eef3;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            background-color: #f3f6fb;
            padding: 20px 0;
            font-size: 18px;
            font-weight: bold;
            color: #CB282B;
        }

        .email-body {
            padding: 20px;
        }

        .email-body h1 {
            font-size: 24px;
            color: #4585EE;
        }

        .email-body p {
            font-size: 16px;
            line-height: 1.5;
            color: #4585EE;
        }

        .email-footer {
            text-align: center;
            padding: 20px;
            background-color: #f3f6fb;
            font-size: 12px;
            color: #4585EE;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            Safety First Medical Service
        </div>
        <div class="email-body">
            <h1>Hello <?php echo e($content->name); ?>!</h1>

            <p>Congratulations! Your Safety First Medical Service account has been successfully created. Please confirm your email address by clicking the button below. You will also need to enter the OTP below to verify your account.</p>

            <p><strong>OTP:</strong> <?php echo e($content->otp); ?></p>

            <div style="display: flex; justify-content: center; margin: 20px 0;">
                <a href="<?php echo e(route('appraisal.user.emailConfirmation', ['e' => $content->email])); ?>" style="background-color: #4585EE; color: white; border-radius: 10px; padding: 10px 20px; text-decoration: none;">Confirm Email</a>
            </div>

            <p>Regards, <br> Safety First Medical Service</p>
            <p>
                <a href="mailto:appraisals@safetyfirstmed.ae">appraisals@safetyfirstmed.ae</a>
            </p>

        </div>  
        <div class="email-footer">
            © Safety First Medical Service All rights reserved.
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\Projects\sf_live\safety\resources\views/mail/auth/user/register.blade.php ENDPATH**/ ?>
<?php
/*
    M-Pesa Integration with PHP
    Part 2: Advanced PHP Integration
    Provided by Burst Digital
    Learn more on our blog: https://burstdigital.co.ke/2023/10/23/integrating-m-pesa-into-your-website-using-php-step-by-step-guide-part-2/
    Contact us at hello@burstdigital.co.ke or call 0708865088 for custom solutions.

    config.php: This file is responsible for configuring the M-Pesa integration settings. It's essential for setting up your API credentials, URLs, and other critical parameters.

    How to use:
    1. Fill in your M-Pesa API credentials, including Consumer Key, Consumer Secret, and other necessary details.
    2. Define your callback URL where M-Pesa will send transaction updates.
    3. Configure other settings as per your integration requirements.

    For a comprehensive guide on integrating M-Pesa with PHP, refer to our detailed blog post.

*/

// M-Pesa API credentials
$consumerKey = 'your-consumer-key';
$consumerSecret = 'your-consumer-secret';
$shortcode = 'your-shortcode';
$lipaNaMpesaOnlinePasskey = 'your-passkey';
$lipaNaMpesaOnlineShortcode = 'your-lipa-na-mpesa-shortcode';

// Business details
$businessShortCode = 'your-business-shortcode';
$callbackURL = 'https://your-callback-url.com'; // Replace with your callback URL
$accountReference = 'your-account-reference';

// Payment request details
$transactionDesc = 'Payment for Order 123';
$transactionType = 'CustomerPayBillOnline';

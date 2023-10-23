<?php
/*
    M-Pesa Integration with PHP
    Part 2: Advanced PHP Integration
    Provided by Burst Digital
    Learn more on our blog: https://burstdigital.co.ke/2023/10/23/integrating-m-pesa-into-your-website-using-php-step-by-step-guide-part-2/
    Contact us at hello@burstdigital.co.ke or call 0708865088 for custom solutions.

    callback.php: This script handles incoming M-Pesa transaction callbacks, ensuring your application stays updated with payment statuses in real-time.

    How to use:
    1. Configure your M-Pesa account's callback URL to point to this script.
    2. When M-Pesa sends a callback, this script verifies the callback's authenticity, processes the transaction data, and sends a response back to M-Pesa.
    3. You can customize this script to update your database, trigger actions based on the transaction status, and more.

    For a step-by-step guide on handling M-Pesa callbacks in PHP, please refer to our comprehensive blog post.

*/

// Include the Daraja API Library
require_once('path/to/Daraja.php');

// Initialize Daraja with your credentials
$daraja = new Daraja([
    'consumerKey' => 'your-consumer-key',
    'consumerSecret' => 'your-consumer-secret',
]);

// Get the callback data
$callbackData = file_get_contents('php://input');

// Verify the callback
$verified = $daraja->verifyCallback($callbackData);

if ($verified) {
    // The callback is valid; you can proceed to process the transaction.
    // Decode the callback data and handle transaction processing here.
    $transaction = json_decode($callbackData);
    // Extract transaction information and update your database as needed.
} else {
    // The callback is not valid; ignore it or log the issue for investigation.
}

// Send a response to acknowledge the callback
header('HTTP/1.1 200 OK');

<?php
/*
    M-Pesa Integration with PHP
    Part 2: Advanced PHP Integration
    Provided by Burst Digital
    Learn more on our blog: https://burstdigital.co.ke/2023/10/23/integrating-m-pesa-into-your-website-using-php-step-by-step-guide-part-2/
    Contact us at hello@burstdigital.co.ke or call 0708865088 for custom solutions.

    webhook.php: This file is used to handle M-Pesa callbacks. It verifies the authenticity of received callbacks, processes the transaction data, and sends a response back to M-Pesa.
*/

// Include the Daraja API Library
require_once('lib/daraja.php');

// Initialize Daraja with your credentials
$daraja = new Daraja([
    'consumerKey' => $consumerKey,
    'consumerSecret' => $consumerSecret,
]);

// Get the callback data
$callbackData = file_get_contents('php://input');

// Verify the callback
$verified = $daraja->verifyCallback($callbackData);

if ($verified) {
    // The callback is valid; you can proceed to process the transaction.
    // Extract and process the transaction data as needed.
    // Send a response to M-Pesa to acknowledge the callback.
} else {
    // The callback is not valid; ignore it or log the issue for investigation.
    // Handle any error or security concerns.
}

// Send a response to M-Pesa
header('HTTP/1.1 200 OK');

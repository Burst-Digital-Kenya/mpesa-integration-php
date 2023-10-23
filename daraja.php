<?php
/*
    M-Pesa Integration with PHP
    Part 2: Advanced PHP Integration
    Provided by Burst Digital
    Learn more on our blog: https://burstdigital.co.ke/2023/10/23/integrating-m-pesa-into-your-website-using-php-step-by-step-guide-part-2/
    Contact us at hello@burstdigital.co.ke or call 0708865088 for custom solutions.

    lib/daraja.php: This library file simplifies M-Pesa integration by providing predefined functions and methods for working with M-Pesa transactions. It is an essential component of your PHP integration.

    How to use:
    1. Include this library in your PHP project to streamline your M-Pesa integration.
    2. Use the provided functions and methods for initiating payments, verifying callbacks, and processing transactions.

    For a detailed guide on integrating M-Pesa with PHP, please refer to our comprehensive blog post.

*/



class Daraja
{
    private $consumerKey;
    private $consumerSecret;
    private $shortcode;
    private $lipaNaMpesaOnlinePasskey;
    private $lipaNaMpesaOnlineShortcode;

    public function __construct($credentials)
    {
        $this->consumerKey = $credentials['consumerKey'];
        $this->consumerSecret = $credentials['consumerSecret'];
        $this->shortcode = $credentials['shortcode'];
        $this->lipaNaMpesaOnlinePasskey = $credentials['lipaNaMpesaOnlinePasskey'];
        $this->lipaNaMpesaOnlineShortcode = $credentials['lipaNaMpesaOnlineShortcode'];
    }

    /**
     * Constructs and returns the payment request.
     *
     * @param array $transactionDetails Details of the payment transaction.
     * @return array An array representing the payment request.
     */
    public function lipaNaMpesaOnline($transactionDetails)
    {
        // Construct the payment request
        $paymentRequest = [
            'BusinessShortCode' => $this->shortcode,
            'Amount' => $transactionDetails['Amount'],
            'PartyA' => $transactionDetails['PartyA'],
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $transactionDetails['PhoneNumber'],
            'CallBackURL' => $transactionDetails['CallBackURL'],
            'AccountReference' => $transactionDetails['AccountReference'],
            'TransactionDesc' => $transactionDetails['TransactionDesc'],
            'TransactionType' => $transactionDetails['TransactionType'],
        ];
        
        return $paymentRequest;
    }

    /**
     * Executes the M-Pesa payment request.
     *
     * @param array $paymentRequest An array representing the payment request.
     * @return mixed The response from the payment request.
     */
    public function execute($paymentRequest)
{
    $url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

    $headers = [
        'Authorization: Basic ' . base64_encode($this->consumerKey . ':' . $this->consumerSecret),
        'Content-Type: application/json',
    ];

    $data = json_encode($paymentRequest);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        return false;
    }

    curl_close($ch);

    return json_decode($response, true);
}

/**
 * Verifies the authenticity of an M-Pesa callback.
 *
 * @param string $callbackData The raw callback data received from M-Pesa.
 * @return bool True if the callback is valid, false otherwise.
 */
public function verifyCallback($callbackData)
{
    $url = 'https://api.safaricom.co.ke/safaricom/identity/v1/checkidentity';

    $headers = [
        'Authorization: Basic ' . base64_encode($this->consumerKey . ':' . $this->consumerSecret),
        'Content-Type: application/json',
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $callbackData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        return false;
    }

    curl_close($ch);

    $result = json_decode($response, true);

    // Check if the result indicates a valid callback
    return isset($result['Valid']) && $result['Valid'] === true;
}
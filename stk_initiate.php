<?php
if (isset($_POST['submit'])) {
    // Validate phone number and amount (you can use more robust validation methods)
    $phonePattern = '/^2547\d{8}$/'; // Kenyan phone number format
    $amount = $_POST['amount'];
    $phone = $_POST['phone'];

    if (!preg_match($phonePattern, $phone) || !is_numeric($amount)) {
        $response = ['status' => 'error', 'message' => 'Invalid phone number or amount.'];
        echo json_encode($response);
        exit;
    }

    // Set the timezone to Nairobi
    date_default_timezone_set('Africa/Nairobi');

    // Constants
    define('CONSUMER_KEY', 'yZ35mihfFSA9eiyE36nG8q5bocypxWp9');
    define('CONSUMER_SECRET', 'lEI6mYl1JHiWOs0C');
    define('BUSINESS_SHORTCODE', '174379');
    define('PASSKEY', 'MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMTYwMjE2MTY1NjI3');
    define('CALLBACK_URL', 'https://mpesa-by-elvis.herokuapp.com/');
    define('API_TOKEN_URL', 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
    define('STK_PUSH_URL', 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');

    // Generate timestamp and password
    $timestamp = date('YmdHis'); // Use Nairobi time
    $password = base64_encode(BUSINESS_SHORTCODE . PASSKEY . $timestamp);


    // Request an access token
    $headers = ['Content-Type: application/json; charset=utf8'];
    $token_data = json_decode(getAccessToken($headers, CONSUMER_KEY, CONSUMER_SECRET), true);

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];

        // Prepare STK Push request data
        $stk_request_data = [
            'BusinessShortCode' => BUSINESS_SHORTCODE,
            'Password' => $password,
            // Add other fields here...
        ];

        // Send STK Push request
        $stk_response = sendStkPushRequest($stk_request_data, $access_token);
        echo $stk_response; // Handle the response as needed
    } else {
        $response = ['status' => 'error', 'message' => 'Unable to obtain access token.'];
        echo json_encode($response);
    }
}

function getAccessToken($headers, $consumerKey, $consumerSecret) {
    $curl = curl_init(API_TOKEN_URL);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $response = ['status' => 'error', 'message' => 'cURL Error: ' . curl_error($curl)];
        return json_encode($response);
    }

    return $response;
}

function sendStkPushRequest($data, $access_token) {
    $headers = ['Content-Type: application/json', 'Authorization: Bearer ' . $access_token];
    $data_string = json_encode($data);
    $curl = curl_init(STK_PUSH_URL);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        $response = ['status' => 'error', 'message' => 'cURL Error: ' . curl_error($curl)];
        return json_encode($response);
    }

    return $response;
}
?>


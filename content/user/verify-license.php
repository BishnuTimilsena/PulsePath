<?php

// API endpoint
$endpoint = 'http://127.0.0.1:5000/verify-license';

// Data to be sent in the POST request as JSON
$data = array(
    'license_number' => $license,
    'dob' => $dob,
    // Add more parameters as needed
);

// Convert data to JSON format
$jsonData = json_encode($data);
// Initialize cURL session
$ch = curl_init($endpoint);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
)
);

// Execute cURL session and get the response
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Display the response from the server
$message = json_decode($response, true)['message'];
if( $message != "Successfully verified" ) {
    $error = $message ;
}
 
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);

    if (!empty($phone)) {
        $apiKey = 'e5fc4f9232af4cd68b851918bf964a67';
        $url = "https://phonevalidation.abstractapi.com/v1/?api_key={$apiKey}&phone={$phone}";
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        echo "<h1>Phone Lookup Results</h1>";
        echo "<p><strong>Phone Number:</strong> {$data['phone_number']}</p>";
        echo "<p><strong>Valid:</strong> " . ($data['valid'] ? 'Yes' : 'No') . "</p>";
        echo "<p><strong>Carrier:</strong> {$data['carrier']}</p>";
        echo "<p><strong>Location:</strong> {$data['location']}</p>";
        echo "<p><strong>Country Code:</strong> {$data['country_code']}</p>";
    } else {
        echo "<p>Invalid phone number.</p>";
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>

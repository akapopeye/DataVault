<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ip = filter_var($_POST['ip'], FILTER_VALIDATE_IP);

    if ($ip) {
        $url = "https://ipapi.co/{$ip}/json/";
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        echo "<h1>IP Lookup Results</h1>";
        echo "<p><strong>IP Address:</strong> {$data['ip']}</p>";
        echo "<p><strong>Hostname:</strong> {$data['hostname']}</p>";
        echo "<p><strong>City:</strong> {$data['city']}</p>";
        echo "<p><strong>Region:</strong> {$data['region']}</p>";
        echo "<p><strong>Country:</strong> {$data['country_name']}</p>";
        echo "<p><strong>Location:</strong> {$data['latitude']}, {$data['longitude']}</p>";
        echo "<p><strong>Organisation:</strong> {$data['org']}</p>";
        echo "<p><strong>AS:</strong> {$data['as']}</p>";
    } else {
        echo "<p>Invalid IP address.</p>";
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>

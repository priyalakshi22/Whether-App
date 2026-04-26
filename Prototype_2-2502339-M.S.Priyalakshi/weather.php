<?php

$servername = "mi-linux.wlv.ac.uk";
$username = "2502339";
$password = "99sf1o";
$dbname = "db2502339";


$apiKey = "ceaea8ad2252b2063b2f85142bc45d7f";


$city = isset($_GET['city']) ? trim($_GET['city']) : '';

if (!$city) {
    echo json_encode(["error" => "City is required"]);
    exit;
}


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM WeatherData WHERE city = ? AND TIMESTAMPDIFF(HOUR, last_updated, NOW()) < 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $city);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    
    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=$apiKey&units=metric";
    $apiResponse = file_get_contents($url);
    $weatherData = json_decode($apiResponse, true);

    if (isset($weatherData['cod']) && $weatherData['cod'] == 200) {
        
        $description = $weatherData['weather'][0]['description'];
        $temperature = $weatherData['main']['temp'];
        $humidity = $weatherData['main']['humidity'];
        $windSpeed = $weatherData['wind']['speed'];
        $insertSql = "INSERT INTO WeatherData (city, weather_description, temperature, humidity, wind_speed) 
                      VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("ssddd", $city, $description, $temperature, $humidity, $windSpeed);
        $insertStmt->execute();

        
        echo json_encode([
            "city" => $city,
            "weather_description" => $description,
            "temperature" => $temperature,
            "humidity" => $humidity,
            "wind_speed" => $windSpeed
        ]);
    } else {
        
        echo json_encode(["error" => "City not found or API error"]);
    }
}

$stmt->close();
$conn->close();
?>

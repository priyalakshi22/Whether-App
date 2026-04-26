<script>
        // Fetch Wolverhampton weather data from API
        fetch('https://api.openweathermap.org/data/2.5/weather?q=kandy&appid=ceaea8ad2252b2063b2f85142bc45d7f&units=metric') // Added &units=metric for Celsius
            .then(response => response.json())
            .then(response => {
                console.log(response);
                document.getElementById("weather-description").innerHTML = "Description: " + response.weather[0].description;
                document.getElementById("temperature").innerHTML = "Temperature: " + response.main.temp + " °C";
                document.getElementById("humidity").innerHTML = "Humidity: " + response.main.humidity + "%";
                document.getElementById("wind-speed").innerHTML = "Wind Speed: " + response.wind.speed + " m/s";
            })
            .catch(err => {
                console.log(err);
            });
    </script>
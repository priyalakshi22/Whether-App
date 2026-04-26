function getWeather() {
    const city = document.getElementById("city-input").value.trim();

    if (!city) {
        alert("Please enter a city or country.");
        return;
    }

    
    const cachedData = localStorage.getItem(city);
    if (cachedData) {
        const weatherData = JSON.parse(cachedData);
        displayWeather(weatherData);
        return;
    }

    const url = `weather.php?city=${encodeURIComponent(city)}`;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            
            localStorage.setItem(city, JSON.stringify(data));

            
            displayWeather(data);
        })
        .catch(err => {
            console.error(err);
            alert("An error occurred. Please try again.");
        });
}

function displayWeather(data) {
    document.getElementById("weather-description").innerHTML = "Description: " + data.weather_description;
    document.getElementById("temperature").innerHTML = "Temperature: " + data.temperature + " °C";
    document.getElementById("humidity").innerHTML = "Humidity: " + data.humidity + "%";
    document.getElementById("wind-speed").innerHTML = "Wind Speed: " + data.wind_speed + " m/s";

    document.getElementById("weather-card").style.display = "block";
}

# 🌤️ Weather Forecast Web App

A responsive weather forecast web application built iteratively across **3 prototypes**, progressively adding features from a static hardcoded display to a fully dynamic, cached, search-enabled app.

---

## 📋 Project Overview

This project was developed as part of the **4CS017** module coursework. It demonstrates the incremental development of a weather application using HTML, CSS, JavaScript, PHP, and MySQL — integrating the **OpenWeatherMap API** for live weather data.

---

## 🔁 Prototype Evolution

### 🟦 Prototype 1 — Static Weather Display
- Hardcoded to display weather for **Kandy, Sri Lanka**
- Fetches live data directly from the **OpenWeatherMap API** via client-side JavaScript (`fetch`)
- Displays: weather description, temperature (°C), humidity (%), and wind speed (m/s)
- Inline CSS styling with an animated sky GIF background
- **No user input or backend**

### 🟨 Prototype 2 — Dynamic City Search + PHP Backend + Database Caching
- Added a **city/country search input** — users can look up weather for any location
- Introduced a **PHP backend** (`weather.php`) to handle API calls server-side
- Integrated a **MySQL database** to cache weather results for **1 hour**, reducing redundant API calls
- Weather card hidden by default and shown only after a successful fetch
- External CSS (`style.css`) separated from HTML

### 🟩 Prototype 3 — Client-Side Caching with localStorage
- Builds on Prototype 2 with an additional **client-side caching layer** using `localStorage`
- Checks `localStorage` before making a network request — instant repeat lookups
- Refactored JS into a reusable `displayWeather()` function for cleaner code
- Two-tier caching: **browser (localStorage)** → **server (MySQL)** → **OpenWeatherMap API**

---

## 🛠️ Tech Stack

| Layer      | Technology                        |
|------------|-----------------------------------|
| Frontend   | HTML5, CSS3, JavaScript (ES6+)    |
| Backend    | PHP                               |
| Database   | MySQL                             |
| API        | OpenWeatherMap (Current Weather)  |
| Fonts      | Google Fonts (Pacifico)           |

---

## 📁 Project Structure

```
weather-app/
│
├── Prototype_1/
│   ├── index.html.html       # Static weather page (Kandy)
│   ├── script.js.js          # Client-side API fetch
│   ├── sky.gif               # Background animation
│   └── UML Diagram1.png      # UML diagram
│
├── Prototype_2/
│   ├── index.html            # City search UI
│   ├── script.js             # Fetch call to PHP backend
│   ├── weather.php           # Server-side API + DB caching
│   ├── style.css             # Shared stylesheet
│   ├── sky.gif               # Background animation
│   ├── Database.png          # Database schema screenshot
│   └── UML Diagram2.png      # UML diagram
│
└── Prototype_3/
    ├── index.html            # City search UI
    ├── script.js             # localStorage + fetch logic
    ├── weather.php           # Server-side API + DB caching
    ├── style.css             # Shared stylesheet
    ├── sky.gif               # Background animation
    ├── Chrome console.png    # Testing screenshot
    └── UML Diagram3.png      # UML diagram
```

---

## ⚙️ Setup & Usage

### Prerequisites
- A web server with **PHP support** (e.g., Apache, XAMPP, university Linux server)
- A **MySQL database**
- An **OpenWeatherMap API key** — get one free at [openweathermap.org](https://openweathermap.org/api)

### Database Setup (Prototype 2 & 3)
Create the following table in your MySQL database:

```sql
CREATE TABLE WeatherData (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city VARCHAR(100) NOT NULL,
    weather_description VARCHAR(255),
    temperature DECIMAL(5,2),
    humidity INT,
    wind_speed DECIMAL(5,2),
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Configuration
In `weather.php`, update the database credentials:

```php
$servername = "your_server";
$username   = "your_username";
$password   = "your_password";
$dbname     = "your_database";
$apiKey     = "your_openweathermap_api_key";
```

### Running the App
- For **Prototype 1**: Open `index.html.html` directly in a browser (no backend needed)
- For **Prototype 2 & 3**: Host files on a PHP-enabled server and navigate to `index.html`

---

## ✨ Features

- 🌍 Search weather for **any city or country** worldwide
- 🌡️ Displays temperature, humidity, wind speed, and weather description
- ⚡ Two-tier caching (localStorage + MySQL) for faster repeat queries
- 📱 Responsive design with mobile viewport support
- 🌅 Animated sky background

---

## 👩‍💻 Author

**M. S. Priyalakshi**  
 

---

## 📄 License

This project was developed for academic purposes as part of a university module assignment.

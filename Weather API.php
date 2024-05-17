<?php

function gatherData($get)
{
    if ($get === false) {
        echo "Error getting data." . PHP_EOL;
        return exit;
    }
    return '';
}

$location = ucfirst(strtolower(readline("Please enter a location of your choice: ")));
$urlLocation = "https://api.openweathermap.org/data/2.5/weather?q=" . $location . "&appid=9d7f76cbb5915b305ba2684e28860cf9";
$getLocation = file_get_contents($urlLocation);

gatherData($getLocation);

$data = json_decode($getLocation, true);
if (isset($data['coord'])) {
    $lat = $data['coord']['lat'];
    $lon = $data['coord']['lon'];
} else {
    echo "Weather data not found." . PHP_EOL;
    exit;
}

$urlWeather = "https://api.openweathermap.org/data/2.5/weather?lat=" . $lat . "&lon=" . $lon . "&appid=9d7f76cbb5915b305ba2684e28860cf9";
$getWeather = file_get_contents($urlWeather);
gatherData($getWeather);


$data2 = json_decode($getWeather, true);

$desc = $data2['weather'][0]['description'];
$temp = $data2['main']['temp'];
$tempCelsius = $temp - 273.15;
$wind = $data2['wind']['speed'];

echo "The weather in $location is a $desc, with winds speeds of $wind and a temperature of $tempCelsius" . "°C." . PHP_EOL;
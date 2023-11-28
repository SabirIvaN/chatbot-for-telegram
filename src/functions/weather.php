<?php

namespace App\Functions\Weather;

function getWeatherText($city_name, $open_weather_map_api_key) {
    $url = 'https://api.openweathermap.org/data/2.5/weather?q=' 
        . $city_name 
        . '&units=metric&appid=' 
        . $open_weather_map_api_key;

    $response = file_get_contents($url);
    $result = json_decode($response, true);

    $temp = $result['main']['temp'];
    $weather_type = $result['weather'][0]['id'];

    $emoji_icon = getWeatherIcon($weather_type);

    $string = 'Погода в городе ' 
        . $city_name 
        . ': ' 
        . $emoji_icon 
        . $temp . '°C';

    return $string;
}

function getWeatherIcon($weather_type) {
    if ($weather_type >= 200 && $weather_type <= 232) {
        $emoji_icon = '⚡';
    } else if ($weather_type >= 300 && $weather_type <= 321) {
        $emoji_icon = '🌧';
    } else if ($weather_type >= 500 && $weather_type <= 531) {
        $emoji_icon = '🌧';
    } else if ($weather_type >= 600 && $weather_type <= 622) {
        $emoji_icon = '❄️';
    } else if ($weather_type >= 701 && $weather_type <= 781) {
        $emoji_icon = '🌪️';
    } else if ($weather_type >= 801 && $weather_type <= 804) {
        $emoji_icon = '🌥️';
    } else if ($weather_type == 800) {
        $emoji_icon = '☁️';
    }
    return $emoji_icon;
}

<?php

/**
 * This namespace contains functions for working with the OpenWeather service.
 */
namespace App\Functions\Weather;

/**
 * This function generates the text to respond to the request.
 *
 * @param [type] $city_name
 * @param [type] $open_weather_map_api_key
 * @return void
 */
function getWeatherText($city_name, $open_weather_map_api_key) {
    $url = 'https://api.openweathermap.org/data/2.5/weather?q=' 
        . $city_name . '&units=metric&appid=' 
        . $open_weather_map_api_key;                // This variable contains the URL for requesting data from OpenWeather.

    $response = file_get_contents($url);            // This variable reads the contents of the file received in the $url and returns a string.
    $result = json_decode($response, true);         // This variable contains the $response line feed function in JSON.

    $temp = $result['main']['temp'];                // This variable gets the temperature from the JSON variable.
    $weather_type = $result['weather'][0]['id'];    // This variable contains the weather type from the JSON variable.
    
    $emoji_icon = getWeatherIcon($weather_type);    // This variable contains a weather type icon.

    $string = 'Погода в городе ' 
        . $city_name . ': ' 
        . $emoji_icon . $temp 
        . '°C';                                     // This variable contains a string with the weather in the city to send.
    
    return $string;                                 // Return of the $string variable.
}

/**
 * This function selects an icon for the type of weather.
 *
 * @param [type] $weather_type
 * @return void
 */
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

    return $emoji_icon;                             // Return of the $emoji_icon variable.
}

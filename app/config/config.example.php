<?php

/**
 * This namespace contains the configuration. To use it, create 
 * a copy of this file and rename it to config.php . Next, 
 * to access Telegram API (https://core.telegram.org/bots/api), 
 * assign BOT_NAME username registered in the chatbot and 
 * BOT_TOKEN token to access the API, and to access OpenWeather 
 * API (https://openweathermap.org/current#builtin), assign 
 * OPEN_WEATHER_MAP_API_KEY the access key to its API.
 */
namespace App\Config;

/**
 * This constant contains the application configuration
 */
const CONFIG =  [
    'BOT_NAME'                  =>  '', // This constant contains the username of the bot registered in Telegram
    'BOT_TOKEN'                 =>  '', // This constant contains a token for accessing a bot registered in Telegram
    'OPEN_WEATHER_MAP_API_KEY'  =>  ''  // This constant contains the key to access OpenWeather
];

#!/usr/bin/env php
<?php

require realpath('./vendor/autoload.php');

use Longman\TelegramBot\Request;
use function App\Weather\getWeatherText;

$config = include('config.php');

$bot_username  = $config['bot_name'];
$bot_api_key = $config['bot_token'];

while (true) {
    try {
        $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
        $telegram->useGetUpdatesWithoutDatabase();
    
        $server_response = $telegram->handleGetUpdates();
    
        if ($server_response->isOk()) {
            $result = $server_response->getResult();
    
            foreach ($result as $message_item) {
                $message = $message_item->getMessage();
    
                $message_chat_id = $message->getFrom()->getId();
                $message_text = $message->getText();
    
                $weather_text = getWeatherText($message_text, $config['open_weather_map_api_key']);
                
                $result = Request::sendMessage([
                    'chat_id' => $message_chat_id,
                    'text' => $weather_text
                ]);
            }
        }
    } catch (Longman\TelegramBot\Exception\TelegramException $e) {
        echo $e->getMessage();
    }
    sleep(1);
}

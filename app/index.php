#!/usr/bin/env php
<?php

require realpath('./vendor/autoload.php');

use Longman\TelegramBot\Request;

use const App\Config\CONFIG;
use function App\Functions\Weather\getWeatherText;

$bot_username  = CONFIG['BOT_NAME'];
$bot_api_key = CONFIG['BOT_TOKEN'];

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
    
                $weather_text = getWeatherText($message_text, CONFIG['OPEN_WEATHER_MAP_API_KEY']);
                
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

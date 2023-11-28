#!/usr/bin/env php
<?php

/**
 * Enabling autoload for Composer.
 */
require realpath('./vendor/autoload.php'); 

/**
 * Connecting library modules to create a bot for Telegram.
 */
use Longman\TelegramBot\Request;                                // Connecting a module for processing and executing requests.
use Longman\TelegramBot\Telegram;                               // Connecting the module to work with the Telegram.
use Longman\TelegramBot\Exception\TelegramException;            // Connecting the module to work with Telegram errors.

/**
 * Enabling a constant with a configuration.
 */
use const App\Config\CONFIG;

/**
 * Enabling the function for generating text with the weather.
 */
use function App\Functions\Weather\getWeatherText;

$bot_username  = CONFIG['BOT_NAME'];                            // Getting the username of the Telegram bot.
$bot_api_key = CONFIG['BOT_TOKEN'];                             // Getting a token for Telegram.

/**
 * Infinite execution.
 */
while (true) {
    /**
     * Execution and error catching.
     */
    try {
        $telegram = new Telegram($bot_api_key, $bot_username);  // Connecting to the Telegram bot.
        $telegram->useGetUpdatesWithoutDatabase();              // Getting updates from Telegram bot.
    
        $server_response = $telegram->handleGetUpdates();       // Processing of receiving updates from the Telegram bot.
    
        /**
         * Checking the response from the Telegram bot.
         */
        if ($server_response->isOk()) {
            $result = $server_response->getResult();            // Getting the results of the response from the server.
    
            /**
             * Processing elements of messages sent by the user to the Telegram bot.
             */
            foreach ($result as $message_item) {
                $message = $message_item->getMessage();         // Getting messages from message elements.
    
                $message_chat_id = $message
                    ->getFrom()
                    ->getId();                                  // Getting the message ID.
                $message_text = $message->getText();            // Receiving the text of the message.
    
                /**
                 * Getting the weather text.
                 */
                $weather_text = getWeatherText($message_text, CONFIG['OPEN_WEATHER_MAP_API_KEY']);
                
                /**
                 * Sending a message to a Telegram bot.
                 */
                $result = Request::sendMessage([
                    'chat_id'   => $message_chat_id,
                    'text'      => $weather_text
                ]);
            }
        }
    } catch (TelegramException $e) {
        echo $e->getMessage();                                  // Receiving an error message.
    }
    sleep(1);                                                   // Postpones the execution of the program.
}

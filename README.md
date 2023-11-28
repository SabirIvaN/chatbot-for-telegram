# The Weather Telegram Chatbot

This is a simple Telegram bot created to display the weather at the user's request.

## Launch Requirements

To launch the bot , you need:
- **PHP** version 8.2.8 and higher;
- **Composer** version 2.4.2 and higher;
- **Telegram** and **OpenWeather** profiles.

Also, for the bot to work, the username and Telegram token of the bot and the key from openweathermap are required. For more information, follow the links – [Telegram Bot API](https://core.telegram.org/bots/api) and [OpenWeather API](https://openweathermap.org/current#name).

## Launch

To launch the bot, follow these steps:
1. Install Composer dependencies using the `make install` Terminal command.
2. Make a copy of the file config.example.php , in the app/config directory, in the same directory and rename it to config.php. 
3. After that, enter the `BOT_NAME` username of your Telegram bot, the `BOT_TOKEN` token of your bot, and the OpenWeather key in `OPEN_WEATHER_MAP_API_KEY`.
4. Run the `make run` command in the Terminal.
5. If you need to update the Composer dependency, you can use the `make update` command.
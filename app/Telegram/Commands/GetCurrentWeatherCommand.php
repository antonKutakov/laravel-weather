<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;
use Services\RapidApi\OpenWeatherMapApi;
use Telegram\Bot\FileUpload\InputFile;

class GetCurrentWeatherCommand extends Command
{
    protected $name = "getcurrentweather";

    protected $description = "Get current weather";

    public $emoji = "⛅";

    private $weather_api = null;

    public function __construct()
    {
        $this->weather_api = new OpenWeatherMapApi(config('rapidapi.api_key'), config('rapidapi.api_host'));
    }

    public function handle()
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $weather = $this->weather_api->getCurrentWeather();

        $this->replyWithPhoto([
            'photo' => InputFile::create('https:'.str_replace('64x64', '128x128',$weather['current']['condition']['icon'])),
            'caption' => implode(PHP_EOL, [
                'City: '.$weather['location']['name'],
                'Region: '.$weather['location']['region'],
                'Country: '.$weather['location']['country'],
                'Current Date: '.date('d M, Y', strtotime($weather['location']['localtime'])),
                'Current time: '.date('H:i', strtotime($weather['location']['localtime'])),
                'Temperature: '.$weather['current']['temp_c'].'°С',
                'Feels like: '.$weather['current']['feelslike_c'].'°С',
                'Weather conditions: '.$weather['current']['condition']['text'],
                'Wind speed: '.$weather['current']['wind_kph'].'км/ч',
                'Chance of precipitation: '.$weather['forecast']['forecastday'][0]['day']['daily_chance_of_rain'].'%',
            ]),
        ]);
    }
}

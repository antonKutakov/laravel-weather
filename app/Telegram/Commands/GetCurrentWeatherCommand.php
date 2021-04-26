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

    private $weather_api = null;

    public function __construct()
    {
        $this->weather_api = new OpenWeatherMapApi(config('rapidapi.api_key'), config('rapidapi.api_host'));
    }

    public function handle()
    {
        $weather = $this->weather_api->getCurrentWeather();

        $this->replyWithPhoto([
            'photo' => InputFile::create('https:'.str_replace('64x64', '128x128',$weather['current']['condition']['icon'])),
            'caption' => implode(PHP_EOL, [
                'Город: '.$weather['location']['name'],
                'Область: '.$weather['location']['region'],
                'Страна: '.$weather['location']['country'],
                'Дата: '.date('d M, Y', strtotime($weather['location']['localtime'])),
                'Текущее время: '.date('H:i', strtotime($weather['location']['localtime'])),
                'Температура: '.$weather['current']['temp_c'].'°С',
                'Чувствуется как: '.$weather['current']['feelslike_c'].'°С',
                'Погодные условия: '.$weather['current']['condition']['text'],
                'Скорость ветра: '.$weather['current']['wind_kph'].'км/ч',
                'Вероятность осадков сегодня: '.$weather['forecast']['forecastday'][0]['day']['daily_chance_of_rain'].'%',
            ]),
        ]);

        $this->replyWithChatAction(['action' => Actions::TYPING]);
    }
}

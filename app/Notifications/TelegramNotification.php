<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile;
use Services\RapidApi\OpenWeatherMapApi;

class TelegramNotification extends Notification
{
    use Queueable;

    /**
     * $api \Services\RapidApi\OpenWeatherMapApi
     *
     */
    private $api;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(OpenWeatherMapApi $api)
    {
        $this->api = $api;
    }

    public function via()
    {
        return [TelegramChannel::class];
    }

    public function toTelegram()
    {
        $weather = $this->api->getCurrentWeather();

        $content = [
            'Дата: '.date('d M, Y H:i', strtotime($weather['location']['localtime'])),
            'Температура: '.$weather['current']['temp_c'].'°С',
            'Чувствуется как: '.$weather['current']['feelslike_c'].'°С',
            'Погодные условия: '.$weather['current']['condition']['text'],
            'Скорость ветра: '.$weather['current']['wind_kph'].'км/ч',
        ];

        return TelegramFile::create()
            ->to(config('services.telegram-bot-api.bot_id'))
            ->content(implode(PHP_EOL, $content))
            ->photo('https:'.str_replace('64x64', '128x128',$weather['current']['condition']['icon']));

    }
}

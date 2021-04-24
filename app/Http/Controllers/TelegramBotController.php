<?php

namespace App\Http\Controllers;

use App\Notifications\TelegramNotification;
use Illuminate\Http\Request;
use Services\RapidApi\OpenWeatherMapApi;

class TelegramBotController extends Controller
{
    private $weather_api = null;

    public function __construct(OpenWeatherMapApi $weather_api)
    {
        $this->weather_api = $weather_api;
    }

    public function index()
    {
        $this->weather_api->notify(new TelegramNotification($this->weather_api));
    }
}

<?php

namespace Services\RapidApi;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http;

class OpenWeatherMapApi
{
    use Notifiable;

    private $api_key = null;
    private $api_host = null;

    public function __construct($api_key, $api_host)
    {
        $this->api_key  = $api_key;
        $this->api_host = $api_host;
    }

    public function getApiKey()
    {
        return $this->api_key;
    }

    public function getApiHost()
    {
        return $this->api_host;
    }

    public function getCurrentWeather()
    {
        $endpoint = "https://weatherapi-com.p.rapidapi.com/forecast.json";

        $response = Http::withHeaders([
            'x-rapidapi-key'  => $this->getApiKey(),
            'x-rapidapi-host' => $this->getApiHost(),
        ])->get($endpoint, [
            "q" => "Nikolaev,ua",
            "days" => "3"
        ]);

        return $response->json();

    }

}

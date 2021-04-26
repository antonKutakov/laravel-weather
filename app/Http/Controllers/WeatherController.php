<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Services\RapidApi\OpenWeatherMapApi;

class WeatherController extends Controller
{

    private $api = null;

    public function __construct(OpenWeatherMapApi $api)
    {
        $this->api = $api;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weather = $this->api->getCurrentWeather();

        $location    = $weather['location'];
        $current     = $weather['current'];
        $forecastDays = $weather['forecast']['forecastday'];

        dd($weather);

        return view('weather.index', [
            'location' => $location,
            'current'  => $current,
            'forecastDays' => $forecastDays
        ]);
    }

}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Services\RapidApi\OpenWeatherMapApi;

class RapidApiProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(OpenWeatherMapApi::class, function () {
            return new OpenWeatherMapApi(config('rapidapi.api_key'), config('rapidapi.api_host'));
        });
    }
}

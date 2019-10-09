<?php

namespace App\Providers;

use App\Services\City\Base\CityServiceInterface;
use App\Services\City\CityService;
use App\Services\Weather\Base\WeatherClientInterface;
use App\Services\Weather\Base\WeatherServiceInterface;
use App\Services\Weather\Clients\Ya\YaWeatherClient;
use App\Services\Weather\WeatherService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //WeatherService bind
        $this->app->bind(
            WeatherServiceInterface::class,
            WeatherService::class
        );

        //YaWeatherClient bind
        $this->app->bind(
            WeatherClientInterface::class,
            YaWeatherClient::class
        );

        //CityService bind
        $this->app->bind(
            CityServiceInterface::class,
            CityService::class
        );
    }
}

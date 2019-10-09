<?php

namespace App\Services\Weather;

use App\Services\City\Base\CityServiceInterface;
use App\Services\Weather\Base\WeatherClientInterface;
use App\Services\Weather\Base\WeatherServiceInterface;

class WeatherService implements WeatherServiceInterface
{
    /**
     * @var WeatherClientInterface
     */
    private $weather_client;
    /**
     * @var CityServiceInterface
     */
    private $city_service;

    /**
     * WeatherService constructor.
     *
     * @param WeatherClientInterface $weather_client
     * @param CityServiceInterface   $city_service
     */
    public function __construct(WeatherClientInterface $weather_client, CityServiceInterface $city_service)
    {
        $this->weather_client = $weather_client;
        $this->city_service   = $city_service;
    }

    /**
     * @param string $city
     *
     * @return string
     */
    public function getCurrentTempInCity(string $city = 'Брянск'): string
    {
        $location = $this->city_service->getLatLonByName($city);

        $weather = $this->weather_client->getByLatLon($location['lat'], $location['lon'])->getCurrentTemp();

        return $weather;
    }
}


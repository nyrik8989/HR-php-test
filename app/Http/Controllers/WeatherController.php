<?php

namespace App\Http\Controllers;

use App\Services\Weather\Base\WeatherServiceInterface;
use Illuminate\Http\Request;

class Weather extends Controller
{
    /**
     * @var WeatherServiceInterface
     */
    private $weather_service;

    public function __construct(WeatherServiceInterface $weather_service)
    {
        $this->weather_service = $weather_service;
    }

    public function index(Request $request)
    {
        $weather = $this->weather_service->getCurrentTempInCity(
            $request->get('city', 'Брянск')
        );

        return view('weather.index', ['weather' => $weather]);
    }
}

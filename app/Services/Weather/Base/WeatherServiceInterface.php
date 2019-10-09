<?php


namespace App\Services\Weather\Base;


interface WeatherServiceInterface
{
    public function getCurrentTempInCity(string $city): string;
}
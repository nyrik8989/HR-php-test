<?php


namespace App\Services\City\Base;


interface CityServiceInterface
{
    public function getLatLonByName(string $name): array;
}
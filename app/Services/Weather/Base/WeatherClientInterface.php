<?php

namespace App\Services\Weather\Base;

interface WeatherClientInterface
{
    public function getCurrentTemp(): string;

    public function getByLatLon(float $lat, float $lon): self;

    public function getByName(string $name): self;
}
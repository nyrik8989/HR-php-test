<?php

namespace App\Services\City;

use App\Services\City\Base\CityServiceInterface;
use Illuminate\Support\Collection;

class CityService implements CityServiceInterface
{
    //    todo dev MOCK
    /**
     * @param string $name
     *
     * @return array|null
     */
    private function getModel(string $name)
    {
        return collect([
            [
                'id'   => 1,
                'name' => 'Брянск',
                'lat'  => 53.1507,
                'lon'  => 34.2218,
            ],
        ])->whereStrict('name', $name)->first();
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function getLatLonByName(string $name): array
    {
        $city = $this->getModel($name);

        return [
            'lat' => $city['lat'],
            'lon' => $city['lon'],
        ];
    }
}
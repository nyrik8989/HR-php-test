<?php

namespace App\Services\Weather\Clients\Ya;

use App\Services\Weather\Base\WeatherClientInterface;
use App\Services\Weather\Clients\Ya\Base\YaWeatherClientException;

class YaWeatherClient implements WeatherClientInterface
{
    /*
     * @var object
     */
    private $response;

    /**
     * @return string
     */
    public function getCurrentTemp(): string
    {
        return $this->response->fact->temp;
    }

    /**
     * @param float $lat
     * @param float $lon
     *
     * @return YaWeatherClient
     * @throws YaWeatherClientException
     */
    public function getByLatLon(float $lat, float $lon): WeatherClientInterface
    {
        $this->response = $this->request([
            'lat' => $lat,
            'lon' => $lon,
        ]);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return YaWeatherClient
     * @throws YaWeatherClientException
     */
    public function getByName(string $name): WeatherClientInterface
    {
        $this->response = $this->request([
            'name' => $name,
        ]);

        return $this;
    }

    /**
     * @param array $params
     *
     * @return array|false
     * @throws YaWeatherClientException
     */
    private function request(array $params)
    {
        $query = '?' . http_build_query($params + ['extra' => 1]);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => config('weather.ya.api.url') . $query,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET",
            CURLOPT_HTTPHEADER     => [
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Host: api.weather.yandex.ru",
                "X-Yandex-API-Key: " . config('weather.ya.api.key'),
                "cache-control: no-cache",
            ],
        ]);

        $response = curl_exec($curl);
        $err      = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new YaWeatherClientException('Request failed');
        } else {
            return json_decode($response);
        }
    }

}
<?php
namespace Anax\Weather;

use Anax\Models\WeatherMock;
use Anax\Models\GetGeoMock;

/**
 * Class for mocking GeoController
 * Class only contain methods for checking
 *
 */
class WeatherControllerMock extends WeatherController
{
    /**
    * Class for mocking the results from weather
    *
    */
    public function checkWeatherActions()
    {

        $lat = $_GET["lan"];
        $lon = $_GET["lon"];

        if ($_GET["type"] == "prognos") {
            $weather = new WeatherMock();
            $forweather = $weather->checkWeather($lat, $lon);
            return $forweather;
        } else {
            $weather = new WeatherMock();
            $histweather = $weather->checkHistory($lat, $lon);
            return $histweather;
        }
    }

    /**
    * Class for mocking the results from ipgeo
    *
    */
    public function getGeo($ip)
    {
        $controller = new GetGeoMock();
        $data = $controller->getGeo($ip);
        return $data;
    }
}

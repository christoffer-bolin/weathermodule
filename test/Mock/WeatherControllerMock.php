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
    public function checkWeatherAction()
    {
        $weather = new WeatherMock();

        $lat = $_GET["lat"];
        $lon = $_GET["lon"];

        if ($_GET["type"] == "prognos") {
            if ($weather->validateNumbersCords($lat, $lon) && $weather->validateCords($lat, $lon)) {
                $forweather = $weather->checkWeather($lat, $lon);
                return $forweather;
            } else {
                return $error = "felaktig input";
            }
        } else {
            if ($weather->validateNumbersCords($lat, $lon) && $weather->validateCords($lat, $lon)) {
                $histweather = $weather->checkHistory($lat, $lon);
                return $histweather;
            } else {
                return $error = "felaktig input";
            }
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

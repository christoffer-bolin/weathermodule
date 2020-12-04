<?php
namespace Anax\Weather;

use Anax\Models\WeatherMock;
use Anax\Models\GetGeoMock;

/**
 * Class for mocking GeoController
 * Class only contain methods for checking
 *
 */
class WeatherJSONControllerMock extends WeatherJSONController
{
    /**
    * Class for mocking the results from weather
    *
    */
    public function checkWeatherRestAction()
    {

        $userlon = "56.16280";
        $userlat = "15.58697";
        $which = "prognos";

        if ($which == "prognos") {
            $weather = new WeatherMock();
            $forweather = $weather->fetchForecastWeather($userlon, $userlat);
            return $forweather;
        } else {
            $weather = new WeatherMock();
            $histweather = $weather->fetchHistoricalWeather($userlon, $userlat);
            return $histweather;
        }
    }

    /**
    * Class for mocking the results from ipgeo
    *
    */
    public function getGeo($userip)
    {
        $ipGeo = new GetGeo();
        $data = $ipGeo->getGeo($userip);
        return $data;
    }
}

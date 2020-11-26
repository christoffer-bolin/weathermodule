<?php

namespace Anax\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Models\WeatherForecast;
use Anax\Models\GetGeo;

class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction()
    {
        $page = $this->di->get("page");
        $title = "Väderprognos";

        $page->add("weather/index");
        return $page->render([
            "title" => $title,
        ]);
    }

    public function checkWeatherAction()
    {
        $page = $this->di->get("page");
        $title = "Resultat";
        $location = $_GET["location"];


        $type = $this->di->get("request")->getGet("type");

        $weather = $this->di->get("weather");
        $geo = new GetGeo();


        if ($type == 'prognos') {
            if (strpos($location, ",") == true) {
                $exploded = explode(",", $location);
                $answer = $weather->checkWeather($exploded[0], $exploded[1]);
            } else {
                $res = $geo->getGeo($location);
                if ($res["longitude"] !== null) {
                    $answer = $weather->checkWeather($res["latitude"], $res["longitude"]);
                } else {
                    $error = "Felaktig input, prova igen!";
                }
            }
        } elseif ($type == 'history') {
            if (strpos($location, ",") == true) {
                $exploded = explode(",", $location);
                $answer = $weather->checkHistory($exploded[0], $exploded[1]);
            } else {
                $res = $geo->getGeo($location);
                if ($res["longitude"] !== null) {
                    $answer = $weather->checkHistory($res["latitude"], $res["longitude"]);
                } else {
                    $error = "Felaktig input, prova igen!";
                }
            }
        }



        $data = [
            "forecast" => $answer ?? null,
            "error" => $error ?? null,
            "lat" => $exploded[0] ?? $res["latitude"],
            "lon" => $exploded[1] ?? $res["longitude"]
        ];


        $page->add("weather/resultpage", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}

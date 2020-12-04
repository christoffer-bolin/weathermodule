<?php

namespace Anax\Models;

class WeatherForecast
{

    public function __construct()
    {
        global $di;
        $this->oneWeek = [];
        $this->weather = [];
    }


    public function fetchApiKey()
    {
        $config = $di->get("configuration")->load("weatherapi.php");
        $access_key = $this->config["config"]["weatherKeyHolder"]["weatherKey"];

        return $access_key;
    }


    public function checkWeather($lat, $lon)
    {
        if ($this->validateNumbersCords($lat, $lon) && $this->validateCords($lat, $lon)) {
            $exclude = "current,minutely,hourly,alerts";

            $access_key = $this->fetchApiKey();

            $ch = curl_init('https://api.openweathermap.org/data/2.5/onecall?lat='.$lat.'&lon='.$lon.'&exclude='.$exclude.'&units=metric&lang=sv&appid='.$this->access_key.'');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Store the data:
            $json = curl_exec($ch);
            curl_close($ch);

            // Decode JSON response:
            $api_result = json_decode($json, true);

            $week = $api_result["daily"];

            foreach ($week as $value) {
                $current = [
                    "date" => gmdate("Y-m-d", $value["dt"]),
                    "temp" => $value["temp"]["min"] . " - " . $value["temp"]["max"],
                    "description" => $value["weather"][0]["description"]
                ];
                $this->oneWeek[] = $current;
            }
        }
        return $this->oneWeek;
    }

    public function getFiveDays()
    {
        $days = [];
        for ($i = 0; $i > -5; $i--) {
            $days[] = strtotime("$i days");
        }
        return $days;
    }

    public function validateCords($lat, $lon)
    {
        if ($lat < 90 && $lat > -90 && $lon < 180 && $lon > -180) {
            return true;
        } else {
            $this->weather = "Felaktig input, försök igen.";
        }
    }

    public function validateNumbersCords($lat, $lon)
    {
        if (!ctype_alpha($lat) && !ctype_alpha($lon)) {
            return true;
        } else {
            $this->weather = "Felaktig input, försök igen.";
        }
    }

    public function checkHistory($lat, $lon)
    {
        if ($this->validateNumbersCords($lat, $lon) && $this->validateCords($lat, $lon)) {
            $pastFiveDays = $this->getFivedays();
            $fetch = 'https://api.openweathermap.org/data/2.5/onecall/timemachine?lat='.$lat.'&lon='.$lon.'&lang=sv&units=metric&dt=';

            $mcurl = curl_multi_init();

            $fiveDays = [];
            foreach ($pastFiveDays as $day) {
                $ch3 = curl_init($fetch.$day.'&APPID='.$this->access_key.'');
                curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
                curl_multi_add_handle($mcurl, $ch3);
                $fiveDays[] = $ch3;
            }

            $run = null;

            do {
                curl_multi_exec($mcurl, $run);
            } while ($run);

            foreach ($fiveDays as $curl) {
                curl_multi_remove_handle($mcurl, $curl);
            }

            curl_multi_close($mcurl);

            foreach ($fiveDays as $day) {
                $output = curl_multi_getcontent($day);
                $exploded = json_decode($output, true);

                $current = [
                    "date" => gmdate("Y-m-d", $exploded["current"]["dt"]),
                    "temp" => $exploded["current"]["temp"],
                    "description" => $exploded["current"]["weather"][0]["description"]
                ];
                $this->weather[] = $current;
            }
        }
        return $this->weather;
    }
}

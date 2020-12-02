<?php

namespace Anax\Models;

class GetGeo
{
    public function getGeo($ip)
    {
        global $di;

        $config = $di->get("configuration")->load("apikey.php");
        $access_key = $config["config"]["keyHolder"]["apiKey"];

        // Initialize CURL:
        $ch = curl_init('http://api.ipstack.com/'.$ip.'?access_key='.$access_key.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Store the data:
        $json = curl_exec($ch);
        curl_close($ch);

        // Decode JSON response:
        $api_result = json_decode($json, true);

        // Output the "capital" object inside "location"
        $data = [
            "city" => $api_result['city'] ?? null,
            "country_name" => $api_result['country_name'] ?? null,
            "region_name" => $api_result['region_name'] ?? null,
            "longitude" => $api_result['longitude'] ?? null,
            "latitude" => $api_result['latitude'] ?? null
        ];

        return $data;
    }
}

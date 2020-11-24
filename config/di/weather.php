<?php
/**
 * Configuration file to add as service in the Di container.
 * find current IP
 */
return [
    "services" => [
        "weather" => [
            "shared" => true,
            "callback" => function () {
                return new \Anax\Models\WeatherForecast();
            }
        ],
    ],
];

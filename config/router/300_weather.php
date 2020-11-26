<?php
/**
 * check if ip is valid
 */
return [
    "routes" => [
        [
            "info" => "Väderprognoser",
            "mount" => "weather",
            "handler" => "\Anax\Weather\WeatherController",
        ],
        [
            "info" => "Väderprognoser JSON",
            "mount" => "weatherapi",
            "handler" => "\Anax\Weather\WeatherJSONController",
        ],
    ]
];

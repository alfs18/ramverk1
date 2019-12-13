<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Kolla väder.",
            "mount" => "rest-weather",
            "handler" => "\Anax\WeatherController\RestWeatherController",
        ],
    ]
];

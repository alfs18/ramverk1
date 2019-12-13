<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Kolla väder.",
            "mount" => "check-weather",
            "handler" => "\Anax\WeatherController\WeatherController",
        ],
    ]
];

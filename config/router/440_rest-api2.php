<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "REST API.",
            "mount" => "restapi2",
            "handler" => "\Anax\CheckIp2\RestApiController2",
        ],
    ]
];

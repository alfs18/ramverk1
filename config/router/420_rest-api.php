<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "REST API.",
            "mount" => "rest-api",
            "handler" => "\Anax\Controller\RestApiController",
        ],
    ]
];

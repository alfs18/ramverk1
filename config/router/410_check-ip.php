<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Check ip.",
            "mount" => "check-ip",
            "handler" => "\Anax\Controller\CheckIpController",
        ],
    ]
];

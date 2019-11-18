<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kmom01",
                        "url" => "redovisning/kmom01",
                        "title" => "Redovisning för kmom01.",
                    ],
                    [
                        "text" => "Kmom02",
                        "url" => "redovisning/kmom02",
                        "title" => "Redovisning för kmom02.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Styleväljare",
            "url" => "style",
            "title" => "Välj stylesheet.",
        ],
        [
            "text" => "Verktyg",
            "url" => "verktyg",
            "title" => "Verktyg och möjligheter för utveckling.",
        ],
        [
            "text" => "Kolla ip",
            "url" => "ip-check",
            "title" => "Kolla ip.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kolla ip v1",
                        "url" => "check-ip/page",
                        "title" => "Kolla ip version 1.",
                    ],
                    [
                        "text" => "Info om ip v1",
                        "url" => "rest-api/json",
                        "title" => "Info om ip version 1.",
                    ],
                    [
                        "text" => "Kolla ip v2",
                        "url" => "check2/page",
                        "title" => "Kolla ip version 2.",
                    ],
                    [
                        "text" => "Info om ip v2",
                        "url" => "restapi2/json",
                        "title" => "Info om ip version 2.",
                    ],
                ],
            ],
        ],
    ],
];

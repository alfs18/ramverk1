<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "class" => "my-navbar",

    // Here comes the menu items/structure
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Om",
                        "url" => "om",
                        "title" => "Om denna webbplats.",
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
                                [
                                    "text" => "Kmom03",
                                    "url" => "redovisning/kmom03",
                                    "title" => "Redovisning för kmom03.",
                                ],
                                [
                                    "text" => "Kmom04",
                                    "url" => "redovisning/kmom04",
                                    "title" => "Redovisning för kmom04.",
                                ],
                                [
                                    "text" => "Kmom05",
                                    "url" => "redovisning/kmom05",
                                    "title" => "Redovisning för kmom05.",
                                ],
                                [
                                    "text" => "Kmom06",
                                    "url" => "redovisning/kmom06",
                                    "title" => "Redovisning för kmom06.",
                                ],
                            ],
                        ],
                    ],
                ],
            ],
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
        [
            "text" => "Kolla vädret",
            "url" => "weather-check",
            "title" => "Kolla väderprognoser.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kolla vädret",
                        "url" => "check-weather/",
                        "title" => "Kolla väderprognoser.",
                    ],
                    [
                        "text" => "REST API",
                        "url" => "rest-weather/",
                        "title" => "Kolla väderprognoser.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Bok",
            "url" => "book",
            "title" => "Kolla böcker",
        ],
    ],
];

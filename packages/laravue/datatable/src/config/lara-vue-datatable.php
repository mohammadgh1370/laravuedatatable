<?php
return [
    "url" => "/",

    "columns" => [
        [
            "label" => "#",
            "name" => "rowId",
            "orderable" => true,
        ],
        [
            "label" => "id",
            "name" => "id",
            "orderable" => true,
        ],
        [
            "label" => "full_name",
            "name" => "full_name",
            "orderable" => true,
        ],
        [
            "label" => "mobile",
            "name" => "mobile",
            "orderable" => true,
        ],
        [
            "label" => "height",
            "name" => "bio.height",
            "orderable" => true,
        ],
        [
            "label" => "created_at",
            "name" => "bio.shamsi_created_at",
            "orderable" => true,
        ],
        [
            "label" => "action",
            "orderable" => false,
            "components" => [
                [
                    "name" => "show",
                    "classes" => [
                        "button" => [
                            "btn" => true,
                            "btn-warning" => true,
                            "btn-sm" => true,
                            "btn-block" => true
                        ],
                        "icon" => [
                            "fa" => true,
                            "fa-eye" => true
                        ]
                    ],
                    "event" => "click",
                    "handler" => "modal",
                    "component" => "data-table-button",
                    "modalComponent" => "example-modal1",
                    "access" => true
                ],
                [
                    "name" => "edit",
                    "classes" => [
                        "button" => [
                            "btn" => true,
                            "btn-success" => true,
                            "btn-sm" => true,
                            "btn-block" => true
                        ],
                        "icon" => [
                            "fa" => true,
                            "fa-pencil" => true
                        ]
                    ],
                    "event" => "click",
                    "handler" => "page",
                    "component" => "data-table-button",
                    "modalComponent" => "example-modal",
                    "access" => true
                ],
                [
                    "name" => "delete",
                    "classes" => [
                        "button" => [
                            "btn" => true,
                            "btn-danger" => true,
                            "btn-sm" => true,
                            "btn-block" => true
                        ],
                        "icon" => [
                            "far" => true,
                            "fa-trash" => true
                        ]
                    ],
                    "method" => "delete",
                    "href" => "url",
                    "component" => "data-table-button",
                    "access" => true
                ]
            ]
        ],
    ],

    "tableClasses" => [
        "table-container" => [
            "table-responsive" => true,
        ],
        "table" => [
            "table" => true,
            "table-striped" => true,
            "border" => true,
        ],
        "t-head" => ["" => ""],
        "t-body" => ["" => ""],
        "td" => ["" => ""],
        "th" => ["" => ""],
        "th-icon" => [
            "asc" => ["fa fa-sort-amount-down-alt" => true],
            "desc" => ["fa fa-sort-amount-down" => true]
        ],
    ],

    "modalClasses" => [
        "modal-lg" => true,
        "modal-dialog-centered" => true
    ],

    "orderBy" => "id",

    "orderDir" => "asc",

    "perPage" => ["10", "25", "50"],

    "pagination" => [
        "limit" => 2,
        "align" => "center",
        "size" => "small"
    ],

    "theme" => "light",

    "cellCheck" => [
        [
            "regex" => "/^(\d{4}).(\d{2}).(\d{2}) (\d{2}):(\d{2}):(\d{2})$/",
            "property" => [
                "style" => [
                    "direction" => "ltr", "display" => "block"
                ],
            ]
        ],
        [
            "name" => "bio.shamsi_created_at",
            "property" => [
                "class" => "badge badge-success"
            ]
        ]
    ],

    "translate" => [
        "nextButton" => "next",
        "previousButton" => "previous",
        "placeholderSearch" => "Search Table",
    ],

    "debounceDelay" => 0,

    "addFiltersToUrl" => false,

    "filters" => ["" => ""],
];

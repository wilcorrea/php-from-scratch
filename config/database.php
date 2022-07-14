<?php

return [
    'drivers' => [
        'json' => [
            'dir' => env('JSON_DRIVER_DIR', __DIR__ . '/../database/json'),
        ],
    ],
];

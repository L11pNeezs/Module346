<?php

return [
    'default' => env('DB_DEFAULT', 'pgsql'),

    'connections' => [
        'pgsql' => [
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '5432'),
            'username' => env('DB_USERNAME', 'postgres'),
            'password' => env('DB_PASSWORD', 'postgres'),
            'database' => env('DB_DATABASE', 'postgres'),
        ],
    ],

    'display_logs' => env('VERBOSE', false) === 'true' && env('DEBUG', false) === 'true',
];

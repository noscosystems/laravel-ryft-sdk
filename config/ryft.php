<?php

// config for Nosco/Ryft
return [
    'auth' => [
        'public' => env('RYFT_PUBLIC_KEY'),
        'private' => env('RYFT_PRIVATE_KEY'),
    ],

    'sandbox' => env('RYFT_SANDBOX', false),

    'rate_limit' => [
        'enabled' => env('RYFT_RATE_LIMIT_ENABLED', true),
        'limit' => [
            'production' => env('RYFT_RATE_LIMIT_PRODUCTION', 25),
            'sandbox' => env('RYFT_RATE_LIMIT_SANDBOX', 5),
        ],
        'window' => env('RYFT_RATE_LIMIT_WINDOW', 1),
        'backoff' => [2, 4, 8, 16, 32, 64, 128, 256, 512],
    ],

    'currency' => env('RYFT_CURRENCY', env('APP_CURRENCY', 'USD')),
];

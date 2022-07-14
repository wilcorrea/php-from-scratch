<?php

return [
    'drivers' => [
        'rabbitmq' => [
            'host' => env('RABBITMQ_HOST', 'bbb-queue'),
            'port' => env('RABBITMQ_PORT', 5672),
            'user' => env('RABBITMQ_USER', 'root'),
            'password' => env('RABBITMQ_PASSWORD', 'root'),
            'exchange' => env('RABBITMQ_EXCHANGE', 'voto-solicitado'),
            'routing_key' => env('RABBITMQ_ROUTING_KEY', 'voto'),
        ]
    ]
];

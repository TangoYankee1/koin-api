<?php

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['POST', 'GET', 'OPTIONS', 'PUT', 'DELETE'],
    'allowed_origins' => [
        'http://localhost:5173',
        'http://localhost:3000',
        'http://localhost:5000',
    ],
    'allowed_headers' => ['*'],
    'supports_credentials' => false,
];

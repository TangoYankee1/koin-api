<?php

return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => [
        'http://localhost:5173',
        'http://localhost:3000',
    ],
    'allowed_headers' => ['*'],
    'supports_credentials' => false,
];

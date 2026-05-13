<?php

return [
    'token' => env('API_TOKEN'),

    'endpoints' => [
        'dni' => 'https://api.decolecta.com/v1/reniec/dni?numero=',
        'ruc' => 'https://api.decolecta.com/v1/sunat/ruc?numero=',
    ],
];
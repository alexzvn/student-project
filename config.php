<?php

return [
    'services' => [
        \Core\Services\SessionService::class,
        \Core\Services\DatabaseService::class,
        \App\Services\AuthService::class,
        \App\Services\CartService::class,
        \App\Services\RouterService::class,
    ],

    'database' => [
        /**
         * Database host address
         */
        'host' => 'localhost',

        /**
         * Username in database
         */
        'user' => 'root',

        /**
         * Password used for login
         */
        'pass' => '',

        /**
         * Database name
         */
        'name' => 'xshop'
    ],

    'categories' => [
        'phone' => ['apple', 'samsung', 'sony', 'xiaomi', 'vinsmart'],
        'laptop' => ['macbook', 'microsoft', 'acer', 'asus'],
        'tablet' => ['ipad', 'samsung'],
    ],
];

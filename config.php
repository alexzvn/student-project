<?php

return [
    'services' => [
        /**
         * Register core services
         */
        \Core\Services\SessionService::class,
        \Core\Services\DatabaseService::class,

        /**
         * Register app services
         */
        \App\Services\HelperService::class,
        \App\Services\AuthService::class,
        \App\Services\CartService::class,

        /**
         * Router must register at bottom to handle request
         */
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

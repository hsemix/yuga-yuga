<?php
/**
 * Holds database settings for all your database connections
 * 
 * @return array
 */
return [
    'db' => [
        'defaultDriver' => env('DATABASE_DRIVER', 'mysql'),
        'mysql' => [
            'driver'    => env('DATABASE_DRIVER', 'mysql'), // Db driver
            'host'      => env('DATABASE_HOST'),
            'database'  => env('DATABASE_NAME'),
            'username'  => env('DATABASE_USERNAME'),
            'password'  => env('DATABASE_PASSWORD'),
            'charset'   => env('DATABASE_CHARSET'), // Optional
            'collation' => 'utf8_unicode_ci', // Optional
            'prefix'    => env('DATABASE_PREFIX'), // Table prefix, optional
            'options'   => [ // PDO constructor options, optional
                PDO::ATTR_TIMEOUT => 5,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_PERSISTENT => true,
            ],
        ],
        'sqlite' => [
            'driver'    => env('DATABASE_DRIVER', 'sqlite'), // Db driver
            'database'    => env('DATABASE_FILE', 'yuga.sqlite'), // stored in the storage/database directory
            'options'   => [ // PDO constructor options, optional
                PDO::ATTR_TIMEOUT => 5,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_PERSISTENT => true,
            ],
        ],
        'postgress' => [
            
        ]
    ]
];
<?php
return [
    'session' => [
        'name' => 'bank_user',
    ],
    'remember' => [
        'name' 	=> 'hash_token',
        'expiry' => 604800
    ],
    'mailable' => [
        'Native' => [
            'from' => 'noreply@yuga.com'
        ],
        'PHPMailer' => [
            'auth' 			=> true, // authentication
            'debug_mode' 	=> 0, // debug mode // for debugging use 2, and 0 on a live server
            'host' 			=> 'mail.malibro.com', // host name
            'username' 		=> 'malibro@malibro.com', // your email address
            'password' 		=> 'flairup@#1234', // password to the provided email address
            'security' 		=> 'ssl', // security mode
            'port' 			=> 465, // port number,
            'is_html' 		=> true,
        ]
    ],
    'app' => [
        'name' => null,
    ]
];
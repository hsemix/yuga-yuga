<?php
/**
 * Holdes App settings for example the session name that you want to use, the remember 
 * key token name that you wish to use
 * And settings for the email clients
 * 
 * @return array
 */
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
            'from' => 'noreply@yuga.com',
            'type' => 'smtp', //quite a few options we have [mail, sendmail or smtp]
            'smtp' => [
                'smtp_host' => '',
                'smtp_port' => 465,
                'smtp_user' => '',
                'smtp_pass' => '',
                'mailtype'  => 'html',
                'charset'   => 'iso-8859-1'
            ]
        ],
        'PHPMailer' => [
            'auth' 			=> true, // authentication
            'debug_mode' 	=> 0, // debug mode // for debugging use 2, and 0 on a live server
            'host' 			=> '', // host name
            'username' 		=> '', // your email address
            'password' 		=> '', // password to the provided email address
            'security' 		=> 'ssl', // security mode
            'port' 			=> 465, // port number,
            'is_html' 		=> true,
        ]
    ],
    'app' => [
        'name' => null,
    ]
];
<?php
/**
 * Holds App settings for example the session name that you want to use, the remember 
 * key token name that you wish to use
 * And settings for the email clients
 * 
 * @return array
 */
return [
    'session' => [
        'name' => 'yuga_session',
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
        ]
    ],
    'app' => [
        'name' => null,
    ]
];
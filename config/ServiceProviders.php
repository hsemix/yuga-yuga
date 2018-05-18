<?php
/**
 * You can add as many providers as you want, by appending or prepending to the array
 */
return [
    \Yuga\Session\SessionServiceProvider::class,
    \Yuga\Providers\ClassAliasServiceProvider::class,
    \Yuga\Views\ViewServiceProvider::class,
    \Yuga\Database\Migration\MigrationServiceProvider::class,
    \Yuga\Mailables\MailableServiceProvider::class,
    \Yuga\Validate\ValidateServiceProvider::class,
];
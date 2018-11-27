<?php

/**
 * Yuga - A PHP Framework (the fastest)
 *
 * @package  Yuga
 * @author   Hamidouh Semix <semix.hamidouh@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../boot/autoload.php';

/**
 * Start the application
 */

$app = require __DIR__.'/../boot/app.php';

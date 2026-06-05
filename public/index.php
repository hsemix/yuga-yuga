<?php

use Yuga\Http\Psr7\Psr7Emitter;
use Yuga\Http\Psr7\ServerRequestFactory;
use Yuga\Runtime\Adapters\FpmRuntime;
use Yuga\Runtime\Adapters\RoadRunnerRuntime;

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
/**
 * Start the application
 */

$app = require __DIR__.'/../boot/app.php';

$request = ServerRequestFactory::fromGlobals();

$response = $app->handle($request);

(new Psr7Emitter())->emit($response);

$app->terminate($request, $response);

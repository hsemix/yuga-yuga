<?php

use josegonzalez\Dotenv\Loader;

define('YUGA_START_TIME', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Composer Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader
| for our application. We just need to utilize it! We'll require it
| into the script here so we do not have to manually load any of
| our application's Main classes. It just feels great to relax.
|
*/
$_ENV['base_path'] = realpath(__DIR__.'/../');
$_ENV['yuga_path'] = __DIR__;
$loader = require $_ENV['base_path'].'/vendor/autoload.php';

include_once $_ENV['base_path'] .'/vendo/yuga/framework/src/Yuga/Support/helpers.php';

if (file_exists($_ENV['base_path'] .'/app/helpers/helpers.php'))
    include_once $_ENV['base_path'] .'/app/helpers/helpers.php';

$Load = new Loader($_ENV['base_path'].'/environment/.env');
// Parse the .env file
$Load->parse();
// Send the parsed .env file to the $_ENV variable
$Load->toEnv();

$loader->addPsr4(env('APP_NAMESPACE', 'App') . '\\', $_ENV['base_path'] . 'app/');
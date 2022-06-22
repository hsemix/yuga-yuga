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
| our application's Main classes.
|
*/
$_ENV['base_path'] = realpath(__DIR__.'/../');
$_ENV['yuga_path'] = __DIR__;
$loader = require $_ENV['base_path'].'/vendor/autoload.php';

if (class_exists(Loader::class)) {
    $env = $_ENV['base_path'] . '/environment/.env';
    if (file_exists($env)) {
        $Load = new Loader($env);
        // Parse the .env file
        $Load->parse();
        // Send the parsed .env file to the $_ENV variable
        $Load->toEnv();

        $loader->addPsr4(env('APP_NAMESPACE', 'App') . '\\', $_ENV['base_path'] . '/app/');
    }
    
} else {
    $vars = json_decode(file_get_contents($_ENV['base_path'] . '/environment/config.json'), true);
    array_map(function ($var, $value) {
        $_ENV[$var] = $value;
    }, array_keys($vars), array_values($vars));
}

$app = new \Yuga\Application\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
*/

$app->run();

return $app;
<?php
require_once 'autoload.php';
$app = new \Yuga\Application\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
*/

return $app;
<?php

Route::get('/', function (Response $response) {
    return $response->json([
        'data' => 'api-data',
    ]);
});
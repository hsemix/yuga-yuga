<?php

Route::get('/', function() {
    return new App\ViewModels\Welcome('Welcome to Yuga Framework');
});

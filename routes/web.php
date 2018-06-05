<?php

Route::get('/', function() {
    return view(new App\ViewModels\Welcome('Welcome to Yuga Framework'));
});

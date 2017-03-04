<?php

use SlimFacades\Route;

Route::get('/test', '\App\Controllers\TestController:home');

$app->get('/', function ($request, $response, $args) {
    return '<h1>Slim boilerplate</h1>';
});
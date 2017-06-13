<?php

use SlimFacades\Route;

Route::get('/', '\App\Controllers\MainController:home');

$app->get('/error', function ($request, $response, $args) {
    mktim();
});
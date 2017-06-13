<?php
require_once('vendor/autoload.php');

use SlimFacades\Facade;
use SlimFacades\Route;
use SlimFacades\App;
use Medoo\Medoo;
use Dopesong\Slim\Error\Whoops as WhoopsError;

$config = require 'config.php';
$app = new \Slim\App($config);

Facade::setFacadeApplication($app);

$container = $app->getContainer();

$container['phpErrorHandler'] = $container['errorHandler'] = function($c) {
    if($c->get('settings')['displayErrorDetails']){
		return new WhoopsError();
	}
};

$container['db'] = function($c) {
	if(empty($c->get('database')['database_name'])) return null;
	return new Medoo($c->get('database'));
};

$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig($c->get('twig')['templates'], $c->get('twig')['options']);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

require_once('routes.php');
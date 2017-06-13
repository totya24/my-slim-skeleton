<?php

/** Environments */
$environments = array(
    'development' => '.local',
    'production' => '.production',
);

foreach($environments as $key => $env){
    if(strstr($_SERVER['SERVER_NAME'], $env) !== false){
        define('ENVIRONMENT', $key);
        break;
    }
}

if(!defined('ENVIRONMENT')) define('ENVIRONMENT', 'production');

switch(ENVIRONMENT){
    case 'development':
        $displayErrors = true;
        $dbHost = 'localhost';
        $dbUser = '';
        $dbName = '';
        $dbPass = '';
        break;
    case 'production':
        $displayErrors = false;
        $dbHost = 'localhost';
        $dbUser = '';
        $dbName = '';
        $dbPass = '';
        break;
}

return [
    'settings' => [
        'displayErrorDetails' => $displayErrors,
    ],
	'database' => [
		'database_type' => 'mysql',
		'database_name' => $dbName,
		'server' => $dbHost,
		'username' => $dbUser,
		'password' => $dbPass,
		'charset' => 'utf8'
	],
	'twig' => [
		'templates' => 'templates',
		'options' => [
			'debug' => false,
			'charset' => 'utf-8',
			'cache' => 'storage/cache/twig',
			'auto_reload' => true
		]
	],
	'assets' => [
		'js' => [
			'header' => [
				'main' => 'js/script.min.js'
			],
			'footer' => [
			]
		],
		'css' => [
			'main' => 'css/style.min.css'
		]
	]
];
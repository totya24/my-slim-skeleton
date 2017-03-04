<?php

return [
    'settings' => [
        'displayErrorDetails' => true,
    ],
	'database' => [
		'database_type' => 'mysql',
		'database_name' => '',
		'server' => '',
		'username' => '',
		'password' => '',
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
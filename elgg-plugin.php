<?php

return [
	'bootstrap' => \hypeJunction\Api\Bootstrap::class,

	'routes' => [
		'api:account:login' => [
			'path' => '/api/account/login',
			'controller' => \hypeJunction\Api\Login::class,
			'middleware' => [
				\hypeJunction\Api\ApiMiddleware::class,
			],
		],
		'api:account:logout' => [
			'path' => '/api/account/logout',
			'controller' => \hypeJunction\Api\Logout::class,
			'middleware' => [
				\hypeJunction\Api\ApiMiddleware::class,
			],
		],
		'api:account:refresh_token' => [
			'path' => '/api/account/refresh_token',
			'controller' => \hypeJunction\Api\RefreshToken::class,
			'middleware' => [
				\hypeJunction\Api\ApiMiddleware::class,
				\hypeJunction\Api\JwtAuthMiddleware::class,
			],
		],
		'api:account:me' => [
			'path' => '/api/account/me',
			'controller' => \hypeJunction\Api\RefreshToken::class,
			'middleware' => [
				\hypeJunction\Api\ApiMiddleware::class,
				\hypeJunction\Api\JwtAuthMiddleware::class,
			],
		],
	],
];

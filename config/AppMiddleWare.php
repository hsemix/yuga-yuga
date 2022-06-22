<?php
/**
 * Register all your app's middleware here
 */
return [
	'guest' => \App\Middleware\RedirectIfAuthenticated::class,
	'api' => \App\Middleware\ApiMiddleware::class,
	'web' => \App\Middleware\WebMiddleware::class,
];
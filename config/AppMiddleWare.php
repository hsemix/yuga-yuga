<?php
/**
 * Register all your app's middleware here
 */
return [
	'guest' => \App\Middleware\RedirectIfAuthenticated::class,
];

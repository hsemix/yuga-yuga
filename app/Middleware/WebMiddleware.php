<?php

namespace App\Middleware;

use Yuga\Http\Middleware\BaseCsrfVerifier;

class WebMiddleware extends BaseCsrfVerifier
{
	protected $except = [];
}
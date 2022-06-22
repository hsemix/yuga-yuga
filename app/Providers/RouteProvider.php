<?php

namespace App\Providers;

use Yuga\Route\Route;
use App\Middleware\WebMiddleware;
use Yuga\Providers\ServiceProvider;
use Yuga\Interfaces\Application\Application;
use Yuga\Route\Exceptions\NotFoundHttpExceptionHandler;

class RouteProvider extends ServiceProvider
{
    protected $users = [];
    protected $namespace = 'App\Controllers';
    /**
     * Register a service to the application
     * 
     * @param \Yuga\Interfaces\Application\Application
     * 
     * @return mixed
     */
    public function load(Application $app)
    {
        return $app;
    }

    public function boot(Route $router)
    {
        $_ENV['ROUTER_BOOTED'] = true;
        $router->group(['prefix' => 'api', 'middleware' => 'api', 'namespace' => $this->namespace], function () { 
            require path('routes/api.php');
        });
        
        $router->group(['middleware' => 'web', 'namespace' => $this->namespace, 'exceptionHandler' => NotFoundHttpExceptionHandler::class], function () use ($router) {
            $router->csrfVerifier(new WebMiddleware);
            require path('routes/web.php');
        });
    }
}
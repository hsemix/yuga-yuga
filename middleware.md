<<<<<<< HEAD
# Middleware

=======
---
description: >-
  Middleware provide a convenient mechanism for filtering HTTP requests entering
  your application. i.e, Yuga includes a middleware that verifies whether the
  user of your application is authenticated.
---

# Middleware

If the user is not authenticated, the middleware will redirect the user to the login screen. However, if the user is authenticated, the middleware will allow the request to proceed further into the application.

Of course, additional middleware can be written to perform a variety of tasks besides authentication. 

There are several middleware that come with yuga-framework, including middleware for authentication and CSRF protection. App middlew middleware are located in the `app/Middleware` directory, but the ones that come with the framework are distributed across the entire framework depending on what they accomplish.

## Defining Middleware

To create a new middleware, use the `make:middleware` command:

```text
php yuga make:middleware CheckRoles
```

This command will place a new `CheckRoles` class within your `app/Middleware` directory. In this middleware, we will only allow access to the route if the user accessing this route is`admin`. Otherwise, we will redirect the users back to the `home` URI:

```php
<?php
namespace App\Middleware;

use Auth;
use Closure;
use Yuga\Http\Request;
use Yuga\Application\Application;
use Yuga\Http\Middleware\IMiddleware;

class CheckAdmins implements IMiddleware
{
    /**
     * @var \Yuga\Application\Application | null
     */
    protected $app;
    /**
     * -------------------------------------------------------------------------
     * Inject any objects (in the contructor) you want to use in this middleware
     * We will worry about instantiating them for you
     * -------------------------------------------------------------------------
     */
    public function __construct(Application $app)
    {
        $this->app      = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Yuga\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function run(Request $request, Closure $next)
    {
        // Write you code for checking if the user's role is admin here
        if (!Auth::user()->isAdmin()) {
           return redirect('home');
        }
        return $next($request);
    }
}
```

#### Assigning Middleware To Routes

If you would like to assign middleware to specific routes, you should first assign the middleware a key in your `config/AppMiddleware` file. By default, the file comes with an array with only one middleware that comes with yuga, feel free to add as many as you want.

You can avoid this by using the command `php yuga make:middleware TestMiddleware` and yuga will make `TestMiddleware` lower cased without the word middleware and will push it to `config/AppMiddleware` array for you.

```php
// Within config/AppMiddleware.php

return [
    'guest' => \App\Middleware\RedirectIfAuthenticated::class,
];
```

 Once the middleware has been defined in the config/AppMiddleware array, you can use on a given route as below:

```php
// Single middleware
Route::get('/users', ['middleware' => 'test', 'UsersController']);
// An array of middleware
Route::get('/users', [
    'middleware' => [
        'middleware1', 
        'middleware2',
    ], 
    'UsersController'
]);

// Middleware on a group of routes

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function ()    {
        // Uses Auth Middleware
    });
​
    Route::get('/user/profile', function () {
        // Uses Auth Middleware
    });
});
```

>>>>>>> 2c47e771248575a7d9b51cea353f7458085d1f98

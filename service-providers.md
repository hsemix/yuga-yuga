---
description: >-
  Service providers are the central place for all Yuga application service
  registering.
---

# Service Providers

Your own application, as well as all of Yuga's core services are registered via service providers. These include:

* Elegant Database 
* View
* Validation
* Session
* Events
* Router
* Console Application, to name but a few.

 Registered Service Providers are found in `config/ServiceProviders.php` When the file is opened, you will see an array return from that file which array contains all the registered `service providers`, When you create a service provider using a `yuga command`, this is where it's registered, you can also insert it there by hand if you will.

### [Creating Service Providers](https://yuga-framework.gitbook.io/documentation/service-providers#creating-service-providers)

All service providers extend the `Yuga\Providers\ServiceProvider` class and they all contain a `load` method, other methods may be introduce in future and we'll let you know. Use the `load` method to bind everything you want to use in you application.

The Yuga command used to generate a service provider is as below:

```text
php yuga make:provider LogServiceProvider
```

#### [The Load Method](https://yuga-framework.gitbook.io/documentation/service-providers#the-load-method)

It's within the `load` method that things are bound to your application, "things" in this case could mean classes that you want your application to have on every single request or strings, it could pretty much be anything.

The following code represents a basic service provider and how the `load` method must be used. All services are bound to the `$app` variable provided as an argument to the `load` method as below:

```php
<?php

namespace App\Providers;

use App\Models\User;
use Yuga\Providers\ServiceProvider;
use Yuga\Interfaces\Application\Application;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function load(Application $app)
    {
        $app->singleton('my-users', function ($app) {
            return User::all();
        });
    }
}
```

#### [Using Service Providers](https://yuga-framework.gitbook.io/documentation/service-providers#using-service-providers)

Inside of your `controllers` or `view-models`, you can get the service that has been already registered in the following way:

```php
<?php

// for a controller

namespace App\Controllers;

use Yuga\Controllers\Controller as BaseController;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function users($app)
    {
        $users = $app->make('my-users');
        
        // or 
        
        $users = $app['my-users'];
    }
}
```

```php
<?php

//for a view-model

namespace App\ViewModels;

class Test extends App
{

    /**
     * Load or / manupulate data when its a get request
     */
    public function onGet()
    {
        $users = app()->make('my-users');
        
        // or 
        
        $users = app()['my-users');
    }
}
```




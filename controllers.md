---
description: >-
  Instead of defining all of your request handling logic as Closures in
  routes/web.php file, you may want to organise them using Controller classes.
  Controllers can group related request handling logic.
---

# Controllers

Controllers are stored in the `app/Controllers` directory by default but in yuga, everything is configurable which means you can put them in `app/AnyFolder` and map them to the appropriate namespace

### [Basic Controllers](https://laravel.com/docs/5.7/controllers#basic-controllers)

#### Defining Controllers

Below is an example of a basic controller class. Note that the controller extends the base controller class that comes with Yuga. The base class provides a few convenience methods such as the `middleware` method, which can be used to attach middleware to controller methods:

```php
<?php

namespace App\Controllers;

use Yuga\Controllers\Controller;
use App\Middleware\UsersViewModel;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return UsersViewModel
     */
    public function show($id)
    {
        return new UsersViewModel($id);
    }
}
```

The route that corresponds to this controller is as below:

```php
Route::get('user/{id}', 'UserController@show');
```

{% hint style="info" %}
Controllers are not **required** to extend the base **controller** but if you don't, you will not have access to important methods like middleware and many others.
{% endhint %}

### [Dependency Injection & Controllers](https://laravel.com/docs/5.7/controllers#dependency-injection-and-controllers)

**Constructor Injection**

The Yuga [service container](https://yuga-framework.gitbook.io/documentation/providers) is used to resolve all Yuga controllers. As a result, you are able to type-hint any dependencies your controller may need in its constructor. The declared dependencies will automatically be resolved and injected into the controller instance:

```php
<?php
namespace App\Controllers;

use App\Models\Posts;
use Yuga\Controllers\Controller;

class UserController extends Controller
{
    /**
     * The posts model instance.
     */
    protected $posts;

    /**
     * Create a new controller instance.
     *
     * @param  Post $post
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->posts = $post;
    }
}
```

You can also type-hint any Yuga classes and interfaces If the container can resolve them, you can type-hint them. 

**Method Injection**

In addition to constructor injection, you can also type-hint dependencies on your controller's methods. A common use-case for method injection is injecting the `Yuga\Http\Request`instance into your controller methods:

```php
<?php
namespace App\Controllers;

use Yuga\Http\Request;
use Yuga\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Store a new post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function save(Request $request)
    {
        $name = $request->get('name');
    }
}
```

If your controller method is also expecting input from a route parameter, list your route arguments any where with other dependencies, remember, Route parameters are injected into route callbacks / controllers based on their names in the Route defined, the order of getting them in callback / controller does not matter. For example, if your route is defined like so:

```php
Route::put('user/{id}', 'UserController@save');
```

You may still type-hint the `Yuga\Http\Request` and access your `id` parameter by defining your controller method as follows:

```php
<?php

namespace App\Controllers;

use Yuga\Http\Request;

class UserController extends Controller
{
    /**
     * Save a given user.
     *
     * @param  Request  $request
     * @param  int $id
     * @return Response
     */
    public function save(Request $request, $id)
    {
        // your code
    }
}

```

OR, like so:

```php
<?php

namespace App\Controllers;

use Yuga\Http\Request;

class UserController extends Controller
{
    /**
     * Save a given user.
     *
     * @param  int $id
     * @param  Request $request
     * @return Response
     */
    public function save($id, Request $request)
    {
        // your code
    }
}

```

{% hint style="info" %}
Route parameters are injected into route callbacks / controllers based on their names in the Route defined, the order of getting them in callback / controller does not matter.
{% endhint %}

#### Creating Controllers using yuga console command

Controllers can be created using the `php yuga make:controller` controller

i.e `php yuga make:controller UsersController` would produce the following scaffold:

```php
<?php

namespace App\Controllers;

use Yuga\Http\Request;
use Yuga\Http\Response;
use Yuga\Http\Redirect;

class UsersController extends Controller
{
    /**
     * Create a new UsersController instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
}

```


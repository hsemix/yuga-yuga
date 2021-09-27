---
description: >-
  Routing allows you to customize your URLs by specifying which URL patterns
  refer to which controllers and actions or ViewModels.
---

# Routing

## Routing

#### Building routes for your application is one way of linking pages through out the entire application. We have quite a few ways you can do that as follows

### Routing

**Basic Routing**

The most basic Yuga routes accept a URI and a `Callback`, providing a very simple and expressive method of defining routes:

```php
Route::get('hello', function () {
    return 'Hello World';
});
```

**The Default Route Files**

All Yuga routes are defined in your routes file, which are located in the `routes` directory. This file is automatically loaded by the framework. The `routes/web.php` file defines routes that are for your web application. These routes automatically have CSRF protection.

**Available Router Methods**

The router allows you to register routes that respond to any HTTP verb:

```php
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
Route::basic($uri, $callback);
Route::form($uri, $callback);
```

Sometimes you may need to use a route that calls multiple HTTP verbs. You can do this by using the `match` method. Or, you may even register a route that responds to all HTTP verbs using the `all`method:

```php
Route::match(['get', 'post'], '/', function () {
    // your code
});

Route::all('foo', function () {
    // your code
});
```

**Route Parameters**

**Required Parameters**

When ever you need to get sections of the URI within your route, this approach might come in handy. E.g. you may want to get the post's id from the URL, you can do that by defining the route parameters:

```php
Route::get('post/{id}', function ($id) {
    return 'Post with id: ' . $id;
});
```

You may define as many route parameters as required by your route:

```php
Route::get('posts/{post}/comments/{comment}', function ($post, $comment) {
    // your code
});
```

Route parameters are always encased within `{}` braces and should consist of alphabetic characters, and may not contain a `-` character. Instead of using the `-` character, use an underscore \(`_`\). Route parameters are injected into route callbacks / controllers based on their names in the Route defined, the order of getting them in callback / controller does not matter.

**Optional Parameters**

Sometimes you may need to specify a route parameter, but make its presence optional, you can do that by placing `?` after the parameter name either in the callback or the controller in which you will use the parameter. Make sure to give an optional parameter a default value in your callback / controller:

```php
Route::get('user/{name?}', function ($name = null) {
    return $name;
});

Route::get('user/{name?}', function ($name = 'Hamnaj') {
    return $name;
});
```

**Regular Expression Constraints**

You may constrain the format of your route parameters using the `where` method on a route instance. The `where` method accepts the name of the parameter and a regular expression defining how the parameter should be constrained:

```php
Route::get('user/{id}', function ($id) {
    // your code
})->where('id', '[0-9]+');

Route::get('user/{id}/{name}', function ($id, $name) {
    // your code
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
```

**Named Routes**

Named routes allow you to conveniently make URLs or redirects for specific routes. You can specify a name for a route by chaining the `name` method onto the route definition:

```php
Route::get('user/posts', function () {
    // your code
})->name('posts');
```

You may also specify route names for controller actions:

```php
Route::get('user/posts', 'UserPostController@get')->name('posts');
```

**Generating URLs To Named Routes**

After giving a name to a route, you can use the route's name in generating the URLs or redirects using the `route` function:

```php
// Creating URLs
$url = route('posts');

// Creating Redirects
return redirect()->route('posts');
```

If the named route defines parameters, you can pass the parameters as the second argument to the `route` function. The given parameters will automatically be inserted into the URL in their correct positions:

```php
Route::get('user/{id}/posts', function ($id) {
    // your code
})->name('posts');

$url = route('posts', ['id' => 1]);
```

**Form Method Spoofing**

HTML forms do not support `PUT`, `PATCH` or `DELETE` actions. So, when defining `PUT`, `PATCH` or `DELETE` routes that are called from an HTML form, you will need to add a hidden `_method` field to the form. The value sent with the `_method` field will be used as the HTTP request method:

```php
<input type="hidden" name="_method" value="PUT" />
```

**Route groups**

Route groups allow you to share route attributes, such as middleware or namespaces, across a large number of routes without needing to define those attributes on each individual route. Shared attributes are specified in an array format as the first parameter to the `Route::group` method.

**Middleware**

To assign middleware to all routes within a group, you may use the middleware key in the group attribute array. Middleware are executed in the order they are listed in the array:

```php
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function ()    {
        // Uses Auth Middleware
    });

    Route::get('/user/profile', function () {
        // Uses Auth Middleware
    });
});
```

**Namespaces**

Another common use-case for route groups is assigning the same PHP namespace to a group of controllers using the `namespace` parameter in the group array:

**Note**

Group namespaces will only be added to routes with relative callbacks. For example if your route has an absolute callback like `\App\Controllers\DashboardController@home`, the namespace from the route will not be prepended. To fix this you can make the callback relative by removing the `\` in the beginning of the callback.

```php
Route::group(['namespace' => 'Admin'], function () {
    // Controllers Within The "App\Controllers\Admin" Namespace
});
```

**Sub domain-routing**

Route groups may also be used to handle sub-domain routing. Sub-domains may be assigned route parameters just like route URIs, allowing you to get a portion of the sub-domain for usage in your route or controller. The sub-domain may be specified using the `domain` keyword on the group attribute array:

```php
Route::group(['domain' => '{account}.myapp.com'], function () {
    Route::get('/user/{id}', function ($account, $id) {
        //
    });
});
```

**Route prefixes**

The `prefix` group attribute may be used to prefix each route in the group with a given URI. For example, you may want to prefix all route URIs within the group with `admin`:

```php
Route::group(['prefix' => '/admin'], function () {
    Route::get('/users', function ()    {
        // Matches The "/admin/users" URL
    });
});
```

**CSRF Protection**

Any forms posting to `POST`, `PUT` or `DELETE` routes should include the CSRF-token. We strongly recommend that you create your enable CSRF-verification on your site. All you need to do in your forms is include this line

```php
<?=token()?>
// or
<input type="hidden" name="_token" value="<?=csrf_token()?>" />
```

**Implicit Routing \(Mapping Routes to Controllers\)**

Some developers that are used to the usual mvc route-to-controller mapping i.e `http://localhost:8000/home` would map to

```php
// the route is /home maps to HomeController@index
(new App\Controllers\HomeController)->index();
```

Yuga-framework supports that too but you must note that this comes turned off by default. It can be turned on by finding the `environment/.env` file and looking for `MATCH_ROUTES_TO_CONTROLLERS` and changing its value to true.

Also note that the order of the routes is `/controller/method/arg1/arg2/args....whatever` When no controller is supplied in the `URI`, the router will default to `HomeController` and when no method is given, then it will default to `HomeController@index`, this can be changed by locating `ROUTE_DEFAULTS` variable in the `environment/.env` file and supplying it with a `json` string of the format

```javascript
{"controller" : "Home", "method" : "index"}
```

Also note that for this to work, the router makes an assumption of the controller living in `app/Controllers` directory and so with a namespace of `App\Controllers`. It also adds the word controller to the URI therefore `/home` is mapped to `HomeController`.

**Page Focused Routing \(Mapping Routes to pages in the view directory\)**

Some developers find it very hard to work with controllers and routes at the same time, besides having implicit routing, yuga-framework supports a page focused routing mechanism, in which a route of any depth is mapped directly to a page inside of the `resources/views/Pages/` directory. E.g

```javascript
http://localhost:8000/home
```

Will be mapped to a page like.

```javascript
<!-- View stored in resources/views/Pages/home.hax.php -->
OR
<!-- View stored in resources/views/Pages/home.php -->
```

> Please note that implicit routing and page-focused routing don't get along, one of them must be turned off for the other to work.

#### Configuration settings for page-focused routing.

All settings for the framework are pretty much put in this file, this goes the same for page-focused routing as well, so locate the following variables and set them to your liking

```javascript
<!-- environment/.env -->
PREFIX_MVP_ROUTE="/pages" # Defaults for '/'
ENABLE_MVP_ROUTES=true # Defaults to false
MVP_CONTROLLER=PageController # Defaults to Controller
```

The following might be the structure of PageController.

```javascript
namespace App\Controllers;

use Yuga\Http\Request;

class PageController extends Controller
{
    /**
     * Any data that is caried down to the Test view
     * Could be records from the database
     */
    protected function renderTest()
    {
        $this->view->name = "Hamid";
    }

    /**
     * Any data that is caried down to the Salaries view
     * Could be records from the database
     */
    protected function renderSalaries()
    {
        $this->view->name = "Jane Doe";
        $this->view->users = [
            ['id' => 1, 'name' => 'Jane Doe',],
        ];
    }

    /**
     * Posting a form from the Salaries view
     * @param Request $request
     */
    protected function onPostSalaries(Request $request)
    {
        /**
         * You have access to the entire request object
         * You can post to the database, send mails, or do any data processing 
         */
        dump($request->except(['_token']));
        return;
    }
    
}
```


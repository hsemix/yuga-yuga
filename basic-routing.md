---
description: >-
  Building routes for your application is one way of linking pages through out
  the entire application. We have quite a few ways you can do that as follows
---

# Basic Routing

### [Basic Routing](https://yuga-framework.gitbook.io/documentation/basic-routing#basic)

The most basic Yuga routes accept a URI and a `Callback`, providing a very simple and expressive method of defining routes:

```php
Route::get('hello', function () {
    echo 'Hello World';
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

### [Route Parameters](https://yuga-framework.gitbook.io/documentation/basic-routing#route-parameter)

#### Required Parameters

When ever you need to get sections of the URI within your route, this approach might come in handy. E.g. you may want to get the post's id from the URL, you can do that by defining the route parameters:

```php
Route::get('post/{id}', function ($id) {
    echo 'Post with id: '.$id;
});
```

You may define as many route parameters as required by your route:

```php
Route::get('posts/{post}/comments/{comment}', function ($post, $comment) {
    // your code
});
```

Route parameters are always encased within `{}` braces and should consist of alphabetic characters, and may not contain a `-` character. Instead of using the `-` character, use an underscore \(`_`\). Route parameters are injected into route callbacks / controllers based on their names in the Route defined, the order of getting them in callback / controller does not matter.

#### Optional Parameters

Sometimes you may need to specify a route parameter, but make its presence optional, you can do that by placing `?` after the parameter name either in the callback or the controller in which you will use the parameter. Make sure to give an optional parameter a default value in your callback / controller:

```php
Route::get('user/{name?}', function ($name = null) {
    echo $name;
});

Route::get('user/{name?}', function ($name = 'Hamnaj') {
    echo $name;
});
```

#### Regular Expression Constraints

You may constrain the format of your route parameters using the `where` method on a route instance. The `where` method accepts the name of the parameter and a regular expression defining how the parameter should be constrained:

```php
Route::get('user/{id}', function ($id) {
    // your code
})->where('id', '[0-9]+');

Route::get('user/{id}/{name}', function ($id, $name) {
    // your code
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
```

### [Named Routes](https://yuga-framework.gitbook.io/documentation/basic-routing#named-routes)

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


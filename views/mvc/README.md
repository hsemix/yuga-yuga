---
description: >-
  MVC stands for model-view-controller pattern, or style, yuga supports this
  very well
---

# MVC

When a developer chooses to use **mvc** as their style with **yuga**, Views are accepted in two formats i.e; _php_ views, in which case there's totally nothing new to learn, or _hax_ views in which case there's a bit of new syntax to learn on how to manipulate and control them.

Views contain the HTML served by your application and separate your controller / application logic from your presentation logic. Views are saved in the `resources/views` directory. A simple view would look like this:

```php
<!-- View stored in resources/views/test.hax.php -->

<html>
    <body>
        <h1>Hello, {{ $name }}</h1>
    </body>
</html>
```

Since this view is stored at `resources/views/test.hax.php`, it can be returned using the global `view` helper like this:

```php
Route::get('/', function () {
    return view('test', ['name' => 'Hamnaj']);
});

// or
Route::get('/', function () {
    return view('test')->with(['name' => 'Hamnaj']);
});
```

As you can see, the first argument passed to the `view` helper corresponds to the name of the view file in the `resources/views` directory. The second argument is an array of data that should be made available to the view. In this case, we are passing the `name` variable, which is displayed in the view using [Hax syntax](https://yuga-framework.gitbook.io/documentation/views/mvc/hax-templates).

Views can also be nested within sub-directories of the `resources/views` directory. **Dot** notation may be used to reference nested views. For example, if your view is stored at `resources/views/users/profile.hax.php`, you can reference it like as below:

```php
return view('users.profile', $data);

// or 

return view('users.profile')->with($data);
```

**Creating The First Available View**

With the `first` method, you can create the first view that exists in a given array of views. This is useful if your application or package allows views to be customized or overwritten:

```php
return view()->first(['my-views.admin', 'admin'], $data);
```

### Passing Data To Views

As you saw in the previous examples, you may pass an array of data to views:

```php
return view('hello', ['name' => 'Hamrad']);
```

When passing information in this format, the data should be an array with key / value pairs. Inside your views, you can then access each value using its corresponding key, such as `<?= $key; ?>`. An alternative syntax can also be used instead of passing the data array as a second parameter in the `view` global function as seen below:

```php
return view('hello')->with('name', 'Hamrad');

// or 

return view('hello')->with(['name' => 'Hamrad']);
```


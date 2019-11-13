---
description: Hax is a very simple but powerful template engine
---

# Hax Templates

 Hax is a simple, yet powerful template engine that comes with yuga. Unlike most of the PHP template engines, Hax does not restrict you from using plain PHP code in your views. Actually, all Hax views are compiled into plain PHP code and cached until they are edited, this means Hax adds basically no overhead to your application. Hax view files use the `.hax.php` file extension and are typically stored in the `resources/views` directory inside of the main directory of your main application.

### [Template Inheritance](https://yuga-framework.gitbook.io/documentation/views/mvc/hax-templates#template-inheritance)

#### [Defining a Layout](https://yuga-framework.gitbook.io/documentation/views/mvc/hax-templates#defining-a-layout)

 There're two primary advantages of using **Hax** i.e; _template inheritance_ and _sections_. To get started, let's take a look at a simple example. First, we will define a **default** page layout. Since most web applications maintain the same general layout across various pages, it's convenient to define this layout as a single **Hax** view:

```php
<!-- Saved in resources/views/layouts/layout.hax.php -->

<html>
    <head>
        <title>Your App Name - @yield('title')</title>
    </head>
    <body>
        @section('nav-bar')
            This is the main nav bar.
        @endsection

        <div class="container">
            @yield('main')
        </div>
    </body>
</html>
```

As you can see, this file contains HTML mark-up. However, take note of the `@section` and `@yield` directives. The `@section` directive, as the name says, defines a section of content, while the `@yield` directive is used to display contents of a given section where the `@yield` directive is found.

Now that we have defined a layout for our application, let's define a child page that inherits the layout.

#### [Extending A Layout](https://yuga-framework.gitbook.io/documentation/views/mvc/hax-templates#extending-a-layout)

When defining a child view, we typically use the Hax `@extends` directive to specify which layout the child view should "inherit". Views that extend a Hax layout can insert content into the layout's sections using `@section` directives. Remember, as seen in the example above, the contents of these sections will be displayed in the layout using `@yield`:

```php
<!-- Stored in resources/views/users.hax.php -->

@extends('layouts.layout')

@section('title') 
    Page Title 
@endsection

@section('nav-bar')
    @parent

    <p>This is appended to the master nav-bar.</p>
@endsection

@section('main')
    <p>This is my body content.</p>
@endsection
```

### [Displaying Data](https://yuga-framework.gitbook.io/documentation/views/mvc/hax-templates#displaying-data)

You can display data passed to your Hax views by wrapping the variable in curly braces. For example, given the following route:

```php
Route::get('hello', function () {
    return view('details', ['name' => 'John Doe']);
});
```

You can display the contents of the `name` variable like below:

```php
Hello, {{ $name }}.
```

### [Control Structures](https://yuga-framework.gitbook.io/documentation/views/mvc/hax-templates#control-structures)

In addition to template inheritance and displaying data, Hax also provides convenient shortcuts for common PHP control structures, such as conditional statements and loops.

#### [If Statements](https://yuga-framework.gitbook.io/documentation/views/mvc/hax-templates#if-statements)

You may construct `if` statements using the `@if`, `@elseif`, `@else`, and `@endif` directives. These directives function identically to their PHP counterparts:

```php
@if (count($items) === 1)
    You have one item!
@elseif (count($items) > 1)
    You have multiple items!
@else
    You don't have any items!
@endif
```

#### [Loops](https://yuga-framework.gitbook.io/documentation/views/mvc/hax-templates#loops)

In addition to conditional statements, Hax provides simple directives for working with PHP's loop structures. Each of these directives functions identically to their PHP counterparts:

```php
@for ($i = 0; $i < 10; $i++)
    The index is {{ $i }}
@endfor

@foreach ($users as $user)
    <p>This is user {{ $user->id }}</p>
@endforeach

@forelse ($users as $user)
    <li>{{ $user->name }}</li>
@endforelse

@while (true)
    <p>This loop will run forever.</p>
@endwhile
```


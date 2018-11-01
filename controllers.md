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


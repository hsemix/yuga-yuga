---
description: >-
  Yuga's database query builder provides a convenient, fluent interface to
  creating and running database queries. It can be used to perform all database
  operations in your application.
---

# Query

## Retrieving results from the database

**Retrieving All Rows From A Table**

You can use the `table` method on the `DB` class to begin a query. The `table` method returns a `\Yuga\Database\Query\DB` query builder instance for the given table, allowing you to chain more constraints onto the query and then finally get the results using the `get` or `all` methods:

```php
<?php
namespace App\Controllers;

class UserController extends BaseController
{
    /**
     * Show a list of all of the users in the database.
     *
     * @return Response
     */
    public function index()
    {
        $users = \DB::table('users')->get();

        return view('user.index', ['users' => $users]);
    }
}
```

The `get / all` methods return a `Yuga\Database\Elegant\Collection` containing the results where each result is an instance of the PHP `stdClass` object. You may access each column's value by accessing the column as a property of the object:

```php
foreach ($users as $user) {
    echo $user->name;
}
```

**Retrieving A Single Row / Column From A Table**

If you just need to retrieve a single row from the database table, you can use the `first / last`methods. These methods will return a single `stdClass` object:

```php
// Retrieve the first record from the collection
$user = DB::table('users')->where('username', 'hamnaj')->first();

// Retrive the last record from the collection
$user = DB::table('users')->where('username', 'hamnaj')->last();

echo $user->name;
```


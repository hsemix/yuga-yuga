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

#### Aggregates

The query builder also provides a variety of aggregate methods such as `count`, `max`, `min`, `avg`, and `sum`. You can call any of these methods after constructing your query:

```php
$users = DB::table('users')->count();

$price = DB::table('orders')->max('price');
```

You can also combine these methods with other clauses:

```php
$price = DB::table('orders')
                ->where('finalized', 1)
                ->avg('price');
```

**Simple query**:  
Get a user with the id of ```3``` . Note that ```null``` is returned when no match is found.  


```php
// This will return a php stdClass object
$users = DB::table('users')->find(3);
```

**Full queries**:  
Get all users with blue or red hair.  


```php
$users = DB::table('users')
                ->where('hair_color', '=', 'blue'))
                ->orWhere('hair_color', '=', 'red')
                ->get();
```

### Select

We recommend that you use ```table()``` method before every `query`, except raw ```query()```.  
To select from more that one table, pass an array of your tables instead of a plain string.  
But this is not a requirement as you can also pass in the different tables as below.

**Method 1** \(array\)

```php
$results = DB::table(['users', 'posts'])
                ->where('users.post_id', 'posts.id')
                ->take(10)
                ->get();
```

**Method 2** \(tables as arguments\)

```php
$results = DB::table('users', 'posts')
                ->where('users.post_id', 'posts.id')
                ->take(10)
                ->get();
```



#### Table alias 

You can easily set the table alias as below:

```php
$query = DB::table(['users' => 'u'])
                ->join('posts', 'posts.user_id', '=', 'u.id');
```

You can change the alias anytime by using:  


```php
$query->alias('uu', 'users'); // uu for users
// or
$query->table('users')->alias('uu');
```

**Output**:

```sql
SELECT *FROM `users` AS `uu` INNER JOIN `posts` ON `posts`.`user_id` = `uu`.`id`
```




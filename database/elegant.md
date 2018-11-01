---
description: >-
  The Elegant ORM is an Active Record implementation that allows you to interact
  with the database using objects that are linked to database tables
---

# Elegant

The Elegant ORM that comes with Yuga provides a beautiful, simple Active Record implementation for working with your database. Each database table has a corresponding "Model" which is used to interact with that table. Models allow you to query for data in your tables, as well as insert new records into the table.

### [Defining Models](https://laravel.com/docs/5.7/eloquent#defining-models)

To get started, let's create an Elegant model. Models typically live in the `app/Models` directory, but you are free to place them anywhere that can be auto-loaded according to your `composer.json`file. All Elegant models extend use `Yuga\Models\ElegantModel` class which also extends `Yuga\Database\Elegant\Model` class, typically, a model can extend `Yuga\Database\Elegant\Model` class directly

The easiest way of creating a model instance is using the `make:model` yuga command

```bash
php yuga make:model User
```

#### Elegant Model Conventions

Now, let's look at an example `User` model, which we will use to retrieve and store information from our `users` database table:

```php
<?php

namespace App;

use Yuga\Database\Elegant\Model;

class User extends Model
{
    //
}
```

**Table Names**

Note that we did not tell Elegant which table to use for our `User` model. By convention, the "snake case", plural name of the class will be used as the table name unless another name is explicitly specified. So, in this case, Elegant will assume the `User` model stores records in the `users` table. You may specify a custom table by defining a `table_name` property on your model:

```php
<?php

namespace App;

use Yuga\Database\Elegant\Model;

class User extends Model
{
    /**
     * The table mapped to the model.
     *
     * @var string
     */
    protected $table_name = 'users_table';
}
```

**Primary Keys**

Elegant will also assume that each table has a primary key column named `id`. You may define a protected `$primaryKey` property to override this convention.

**Timestamps**

By default, Elegant expects `created_at` and `updated_at` columns to exist on your tables. If you do not wish to have these columns automatically managed by Elegant, set the `$timestamps` property on your model to `false`:

```php
<?php

namespace App;

use Yuga\Database\Elegant\Model;

class User extends Model
{
    /**
     * Shows if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
```

If you wish to just rename the fields from being `$created_at` for new records and `$updated_at` for updated records, you can do this by:



```php
<?php

namespace App;

use Yuga\Database\Elegant\Model;

class User extends Model
{
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';
}
```



### [Retrieving Models](https://yuga-framework.gitbook.io/documentation/database/elegant#retrieving-models)

Once you have created a model and its associated database table, you are ready to start retrieving data from your database. Take it that each Elegant model is an improved [query builder](https://yuga-framework.gitbook.io/documentation/database/query) allowing you to fluently query the database table associated with the model. For example:

```php
<?php

$users= App\User::all();

foreach ($users as $user) {
    echo $user->name;
}
```

**Adding Additional Constraints**

The Elegant `all` method will return all of the results in the model's table. Since each Elegant model serves as a [query builder](https://yuga-framework.gitbook.io/documentation/database/query), you may also add constraints to queries, and then use the `get / all`method to retrieve the results:

```php
$users = App\User::where('active', 1)
               ->orderBy('name', 'desc')
               ->take(10)
               ->get();
// or 

$users = App\User::where('active', 1)
               ->orderBy('name', 'desc')
               ->take(10)
               ->all();
```

{% hint style="info" %}
 Since Elegant models are improved query builders, you may want to review all of the methods available on the [query builder](https://yuga-framework.gitbook.io/documentation/database/query). You may use any of these methods in your Elegant queries.
{% endhint %}


---
description: >-
  The Elegant ORM is an Active Record implementation that allows you to
  interact  with the database using objects that are linked to database tables
---

# Elegant

The Elegant ORM that comes with Yuga provides a beautiful, simple Active Record implementation for working with your database. Each database table has a corresponding "Model" which is used to interact with that table. Models allow you to query for data in your tables, as well as insert new records into the table.

#### [Defining Models](https://yuga-framework.gitbook.io/documentation/database/elegant) <a id="markdown-header-defining-models"></a>

To get started, let's create an Elegant model. Models typically live in the `app/Models` directory, but you are free to place them anywhere that can be auto-loaded according to your `composer.json`file. All Elegant models extend use `Yuga\Models\ElegantModel` class which also extends `Yuga\Database\Elegant\Model` class, typically, a model can extend `Yuga\Database\Elegant\Model` class directly

The easiest way of creating a model instance is using the `make:model` yuga command

```text
php yuga make:model User
```

**Elegant Model Conventions**

Now, let's look at an example `User` model, which we will use to retrieve and store information from our `users` database table:

```php
<?php

namespace App\Models;

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

namespace App\Models;

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

namespace App\Models;

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

namespace App\Models;

use Yuga\Database\Elegant\Model;

class User extends Model
{
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';
}
```

#### [Retrieving Models](https://yuga-framework.gitbook.io/documentation/database/elegant#retrieving-models) <a id="markdown-header-retrieving-models"></a>

Once you have created a model and its associated database table, you are ready to start retrieving data from your database. Take it that each Elegant model is an improved [query builder](https://yuga-framework.gitbook.io/documentation/database/query) allowing you to fluently query the database table associated with the model. For example:

```php
<?php

$users= App\Models\User::all();

foreach ($users as $user) {
    echo $user->name;
}
```

**Adding Additional Constraints**

The Elegant `all` method will return all of the results in the model's table. Since each Elegant model serves as a [query builder](https://yuga-framework.gitbook.io/documentation/database/query), you may also add constraints to queries, and then use the `get / all`method to retrieve the results:

```php
$users = App\Models\User::where('active', 1)
               ->orderBy('name', 'desc')
               ->take(10)
               ->get();
// or 

$users = App\Models\User::where('active', 1)
               ->orderBy('name', 'desc')
               ->take(10)
               ->all();
```

{% hint style="info" %} Since Elegant models are improved query builders, you may want to review all of the methods available on the [query builder](https://yuga-framework.gitbook.io/documentation/database/query). You may use any of these methods in your Elegant queries. {% endhint %}

**Collections**

For Elegant methods like `all` and `get` which retrieve multiple results, an instance of `Yuga\Database\Elegant\Collection` will be returned. The `Collection` class provides a variety of helpful methods for working with your Elegant results:

You can loop over the collection like an array:

```php
foreach ($users as $user) {
    echo $user->name;
}
```

**Chunking Results**

If you need to process thousands of Elegant results, use the `chunk` method. The `chunk`method will retrieve a "chunk" of Elegant models, putting them to a given `Closure` for processing. Using the `chunk` method will conserve memory when working with large result sets:

```php
User::chunk(200, function ($users) {
    foreach ($users as $user) {
        //your code
    }
});
```

The first argument passed to the method is the number of records you wish to receive per "chunk". The Closure passed as the second argument will be called for each chunk that is retrieved from the database. A database query will be executed to retrieve each chunk of records passed to the Closure.

#### Retrieving Single Models / Aggregates <a id="markdown-header-retrieving-single-models-aggregates"></a>

In addition to retrieving all of the records for a given table, you can also retrieve single records using `find`or `first` or `last` . Instead of returning a collection of models, these methods return a single model instance:

```php
// Retrieve a model by its primary key...
$users = App\Models\User::find(1);

// Retrieve the first model matching the query constraints...
$users = App\Models\User::where('active', 1)->first();

// Retrieve the last model matching the query constraints...
$users = App\Models\User::where('active', 1)->last();
```

You may also call the `find` method with an array of primary keys, which will return a collection of the matching records:

```php
$users = App\Models\User::find([1, 2, 3]);
```

**Retrieving Aggregates**

You may also use the `count`, `sum`, `max`, and other aggregate methods provided by the [query builder](https://yuga-framework.gitbook.io/documentation/database/query). These methods return the appropriate scalar value instead of a full model instance:

```php
$count = App\Models\User::where('active', 1)->count();

$sum = App\Models\Users::where('active', 1)->sum('admins');
```

#### Inserting & Updating Models <a id="markdown-header-inserting-updating-models"></a>

**Inserts**

To create a new record in the database, create a new model instance, set attributes on the model, then call the `save` method:

```php
<?php

namespace App\Controllers;

use App\Models\User;
use Yuga\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new Users instance.
     *
     * @param  Request  $request
     * 
     * @return Response
     */
    public function save(Request $request)
    {
        // This should be done in a ViewModel though

        $user = new User;

        $user->name = $request->get('name');

        $user->save();
    }
}
```

In this example, we assign the `name` array key from the incoming HTTP request `get` method to the `name`attribute of the `App\Models\User` model instance. When we call the `save` method, a record will be inserted into the database. The `created_at` and `updated_at` timestamps will automatically be set when the `save` method is called, so there is no need to set them manually.

**Updates**

The `save` method may also be used to update models that already exist in the database. To update a model, you should retrieve it, set any attributes you wish to update, and then call the `save` method. Again, the `updated_at` timestamp will automatically be updated, so there is no need to manually set its value:

```php
$user = App\Models\User::find(1);

$user->name = 'Hamnaj';

$user->save();
```

**Mass Updates**

Updates can also be performed against any number of models that match a given query. In this example, all users that are `active` and have a `duty role` as true:

```php
$users = App\Models\User::where('active', 1)
          ->where('on_duty', false)
          ->update(['on_duty' => 1]);
// or 
$users = App\Models\User::where('active', 1)
          ->where('on_duty', false)
          ->save(['on_duty' => 1]);
```

The `update / save` method expects an array of column and value pairs representing the columns that should be updated.

**Mass Assignment**

You may also use the model's `__contruct` method to save a new model in a single line. The inserted model instance will be returned to you from the method. However, before doing so, you will need to specify either a `fillable`

```php
<?php

namespace App\Models;

use Yuga\Database\Elegant\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
```

Once we have made the attributes mass assignable, we can use the `__constuct` method to insert a new record in the database. The model is returned to you instantly:

```php
$user = (new App\Models\User(['name' => 'Hamnaj']))->save();
```

**Other Creation Methods**

**create/ firstOrCreate/ firstOrNew**

There are three other methods you may use to create models by mass assigning attributes: `create`, `firstOrCreate` and `firstOrNew`. The `firstOrCreate` method will attempt to locate a database record using the given column / value pairs. If the model can not be found in the database, a record will be inserted with the attributes from the first parameter, along with those in the optional second parameter.

The `firstOrNew` method, like `firstOrCreate` will attempt to locate a record in the database matching the given attributes. However, if a model is not found, a new model instance will be returned. Note that the model returned by `firstOrNew` has not yet been persisted to the database. You will need to call `save`manually to persist it:

```php
// Retrieve user by name, or create it if it doesn't exist...
$user = App\Models\User::firstOrCreate(['name' => 'Hamnaj']);

// Retrieve user by name, or create it with the name and admin attributes...
$user = App\Models\User::firstOrCreate([
    'name' => 'Hamnaj', 
    'admin' => 1
]);

// Retrieve by name, or instantiate...
$user = App\Models\User::firstOrNew(['name' => 'Hamnaj']);

// Retrieve by name, or instantiate with the name and admin attributes...
$user = App\Models\User::firstOrNew([
    'name' => 'Hamnaj', 
    'admin' => 1
]);

// Create a user with the create method
$user = App\Models\User::create([
    'name' => 'Hamnaj'
]);
```

**updateOrCreate**

You may also come across situations where you want to update an existing model or create a new model if none exists. Elegant provides an `updateOrCreate` method to do this in one step. Like the `firstOrCreate`method, `updateOrCreate` persists the model, so there's no need to call `save()`:

```php
// If there's a user whose name is jakat update the other field(age)
// If no matching model exists, create one.
$user = App\Models\User::updateOrCreate(
    ['name' => 'Jakat',],
    ['age' => 30,]
);
```

#### [Deleting Models](https://yuga-framework.gitbook.io/documentation/elegant#deleting-models) <a id="markdown-header-deleting-models"></a>

To delete a model, call the `delete` method on a model instance:

```php
$user = App\Models\User::find(1);

$user->delete();
```

By default Elegant will `soft delete` database results when the `delete` method is called on a `model`. To delete a result or a set of results \(force delete\), a `\Yuga\Database\Elegant\Traits\PermanentDeleteTrait`trait must be used in a model, once that trait is used,

```php
<?php
// In your model class
namespace App\Models;

use Yuga\Database\Elegant\Model;
use Yuga\Database\Elegant\Traits\PermanentDeleteTrait as PermanentDelete;

class User extends Model
{
    use PermanetDelete;
}



// In your controller or view-model
$users = App\Models\User::where('salary', '>', 10000);

$users->delete();
```

will delete all those users permanently from the table.

**Querying Soft Deleted Models**

**Including Soft Deleted Models**

As noted above, soft deleted models will automatically be excluded from query results. However, you may force soft deleted models to appear in a result set using the `withTrashed`method on the query:

```php
$users = App\Models\User::withTrashed()
                ->where('account_type_id', 1)
                ->get();
```

The `withTrashed` method may also be used on a [relationship](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships) query:

```php
$user->posts()->withTrashed()->get();
```

**Retrieving Only Soft Deleted Models**

The `onlyTrashed` method will retrieve **only** soft deleted models:

```php
$users = App\Models\User::onlyTrashed()
                ->where('account_type_id', 1)
                ->get();
```

**Restoring Soft Deleted Models**

Sometimes you may wish to "un-delete" a soft deleted model. To restore a soft deleted model into an active state, use the `restore` method on a model instance:

```php
$users->restore();
```

You may also use the `restore` method in a query to quickly restore multiple models. Again, like other "mass" operations, this will not fire any model events for the models that are restored:

```php
$restored = App\Models\User::withTrashed()
                ->where('account_type_id', 1)
                ->restore();
```

Like the `withTrashed` method, the `restore` method may also be used on [relationships](https://yuga-framework.gitbook.io/documentation/database/elegant/relationships):

```php
$user->posts()->restore();
```


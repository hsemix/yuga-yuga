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

